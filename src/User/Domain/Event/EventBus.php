<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Event;

interface EventBus
{
    public function dispatch(Event ...$events): void;
}
