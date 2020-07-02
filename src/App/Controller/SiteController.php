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
    public const PER_PAGE = 3;
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

        $limit = self::PER_PAGE;
        $offset = ($page - 1) * $limit;

        $currencies = $currency->getAll($offset, $limit);
        if (!empty($currencies['currencies'])) {
            $currencies['pages'] = [
                'self' => $page,
                'first' => 1,
                'last' => ceil($currency->countAll() / self::PER_PAGE),
            ];

            return new JsonResponse($currencies);
        }
        return new JsonResponse('Error.');
    }

    public function currency($id)
    {
        $currency = new Currency($this->pdo);

        if ($result = $currency->find($id)) {
            return new JsonResponse($result);
        }
        return new JsonResponse('Not Found.');
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