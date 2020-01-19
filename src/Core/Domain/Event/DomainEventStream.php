<?php

declare(strict_types=1);

namespace Acme\MessengerPlayground\Core\Domain\Event;

use Iterator;

class DomainEventStream implements Iterator
{
    /** @var DomainEvent[] */
    private array $stream;

    private int $pointer;

    public function __construct()
    {
        $this->stream = [];
        $this->pointer = 0;
    }

    public function push(DomainEvent $event): self
    {
        $this->stream[] = $event;

        if (null === $this->pointer) {
            $this->pointer = 0;
        }

        return $this;
    }

    public function each(callable $fn): void
    {
        while ($event = $this->read()) {
            $fn($event);
        }
    }

    public function read(): ?DomainEvent
    {
        $current = $this->current();
        $this->next();

        return $current;
    }

    public function current(): ?DomainEvent
    {
        return $this->stream[$this->pointer] ?? null;
    }

    public function next(): void
    {
        unset($this->stream[$this->pointer]);
        ++$this->pointer;
    }

    public function map(callable $fn): array
    {
        $result = [];

        while ($event = $this->read()) {
            $result[] = $fn($event);
        }

        return $result;
    }

    public function key(): int
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return (bool)$this->current();
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }

    public function pull(): array
    {
        $stream       = $this->stream;
        $this->stream = [];

        return $stream;
    }
}
