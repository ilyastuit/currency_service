<?php

namespace App\Event;

use App\Model\User;
use App\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class SimpleListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {

    }

    public static function getSubscribedEvents()
    {
        return ['response' => 'onResponse'];
    }
}