<?php

namespace App\Controller;

use App\Model\Currency;
use App\Model\User;
use http\Exception\BadHeaderException;
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
        $page = $request->attributes->get('page');

        $user = new User($this->pdo);
        $authorizationHeader = $request->headers->get('Authorization', false);

        try {
            $user->authorize($authorizationHeader);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage());
        }

        return new JsonResponse('123');
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