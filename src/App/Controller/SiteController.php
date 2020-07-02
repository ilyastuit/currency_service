<?php

namespace App\Controller;

use App\Model\Currency;
use App\Model\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteController
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function index(Request $request): Response
    {
        $currency = new Currency($this->pdo);
        $user = new User($this->pdo);
        $authorizationHeader = $request->headers->get('Authorization', false);

        if ($authorizationHeader) {
            $user = $user->findByToken(substr($authorizationHeader, 7));
        } else {
            return new JsonResponse('Bearer authorization failed.');
        }
        if (!$user) {
            return new JsonResponse('Token not valid.');
        }
        return new JsonResponse($user);
    }

    public function auth(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $user = new User($this->pdo);
            $fields['username'] = $request->get('username', false);
            $fields['password'] = $request->get('password');
            if (
                $fields['username'] &&
                $user->findByUsernameAndPassword($fields) &&
                $user->updateTokenAndTime(['token' => time(), 'username' => $fields['username']])
            )
            {
                $user = $user->findByUsernameAndPassword($fields);
                return new JsonResponse([
                    'token' => $user['token'],
                    'token_expire_time' => $user['token_expire_time'],
                ]);
            }
        }
        return new JsonResponse('Error.');

    }
}