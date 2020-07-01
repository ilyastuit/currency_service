<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteController
{
    public function index(Request $request)
    {
        return new Response('Hello ' . ($request->attributes->get('name') ?? 'Guest'));
    }
}