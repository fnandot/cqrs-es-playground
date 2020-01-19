<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Infrastructure\Bus\Event;

use Acme\MessengerPlayground\Core\Domain\Event\DomainEvent;
use Acme\MessengerPlayground\Core\Domain\Event\DomainEventBus;

final class InMemoryDomainEventBus implements DomainEventBus
{
    /** @var DomainEvent[] */
    private array $dispatchedEvents;

    public function __construct()
    {
        $this->dispatchedEvents = [];
    }

    public function dispatch(DomainEvent ...$events): void
    {
        $this->dispatchedEvents += $events;
    }

    /**
     * @return DomainEvent[]
     */
    public function pullDispatchedEvents(): array
    {
        $dispatched = $this->dispatchedEvents;
        $this->dispatchedEvents = [];

        return $dispatched;
    }
}
