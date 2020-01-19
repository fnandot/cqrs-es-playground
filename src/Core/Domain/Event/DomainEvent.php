<?php

declare(strict_types=1);


namespace Acme\MessengerPlayground\Core\Domain\Event;

use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use DateTimeImmutable;

interface DomainEvent
{
    public function identifier(): EventIdentifier;

    public function occurredOn(): DateTimeImmutable;
}
