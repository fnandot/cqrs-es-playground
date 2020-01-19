<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\Core\Domain\Event;

interface DomainEventBus
{
    public function dispatch(DomainEvent ...$events): void;
}
