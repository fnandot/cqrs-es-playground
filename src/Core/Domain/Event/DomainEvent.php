<?php

declare(strict_types=1);


namespace Acme\MessengerPlayground\Core\Domain\Event;

use Acme\MessengerPlayground\Core\Domain\ValueObject\AggregateIdentifier;
use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use DateTimeImmutable;

interface DomainEvent
{
    public function aggregateIdentifier(): AggregateIdentifier;

    public function occurredOn(): DateTimeImmutable;
}
