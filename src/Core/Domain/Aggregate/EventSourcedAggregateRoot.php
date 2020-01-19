<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\Core\Domain\Aggregate;

use Acme\MessengerPlayground\Core\Domain\Event\DomainEvent;
use Acme\MessengerPlayground\Core\Domain\Event\DomainEventStream;

abstract class EventSourcedAggregateRoot
{
    private DomainEventStream $domainEventStream;

    protected function recordThat(DomainEvent $event): void
    {
        if (false === isset($this->domainEventStream)) {
            $this->domainEventStream = new DomainEventStream();
        }

        $this->domainEventStream->push($event);

        $this->apply($event);
    }

    abstract protected function apply(DomainEvent $event): void;

    /**
     * @return DomainEvent[]
     */
    public function pullDomainEvents(): array
    {
        return $this->domainEventStream->pull();
    }
}
