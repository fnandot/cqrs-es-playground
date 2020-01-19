<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Infrastructure\Framework\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class BeforeActionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'convertJsonStringToArray',
        ];
    }

    public function convertJsonStringToArray(KernelEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getContentType() !== 'json' || !$request->getContent()) {
            return;
        }

        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        //if (json_last_error() !== JSON_ERROR_NONE) {
        //    throw new BadRequestHttpException('invalid json body: ' . json_last_error_msg());
        //}

        $request->request->replace(is_array($data) ? $data : []);
    }

}
