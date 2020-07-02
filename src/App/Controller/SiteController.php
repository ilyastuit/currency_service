<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteController
{
    public function index(Request $request): Response
    {
        return new Response('Hello ' . ($request->attributes->get('name') ?? 'Guest'));
    }

    public function auth(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $fields['username'] = $request->get('username');
            $fields['password'] = $request->get('password');
            return new JsonResponse($fields);
        }
        return new JsonResponse('Not found');

    }
}