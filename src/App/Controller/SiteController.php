<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteController
{
    public function index(Request $request): Response
    {
        return new Response('Hello ' . ($request->attributes->get('name') ?? 'Guest'));
    }
}