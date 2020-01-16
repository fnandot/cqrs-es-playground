<?php

declare(strict_types = 1);


namespace Acme\MessengerPlayground\User\Domain\Event;

use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use DateTimeImmutable;

interface Event
{
    public function identifier(): EventIdentifier;

    public function occurredOn(): DateTimeImmutable;
}
