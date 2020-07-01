<?php

namespace App\Event;

use App\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class SimpleListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $event->getResponse()->setContent('Fatal Error');
    }

    public static function getSubscribedEvents()
    {
        return ['response' => 'onResponse'];
    }
}