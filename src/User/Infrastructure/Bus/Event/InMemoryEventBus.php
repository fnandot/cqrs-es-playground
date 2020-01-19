<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Infrastructure\Bus\Event;

use Acme\MessengerPlayground\User\Domain\Event\Event;
use Acme\MessengerPlayground\User\Domain\Event\EventBus;

final class InMemoryEventBus implements EventBus
{
    /** @var Event[] */
    private array $dispatchedEvents;

    public function __construct()
    {
        $this->dispatchedEvents = [];
    }

    public function dispatch(Event ...$events): void
    {
        $this->dispatchedEvents += $events;
    }

    /**
     * @return Event[]
     */
    public function pullDispatchedEvents(): array
    {
        $dispatched = $this->dispatchedEvents;
        $this->dispatchedEvents = [];

        return $dispatched;
    }
}
