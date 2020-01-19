<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\Core\Domain\Event;

use Acme\MessengerPlayground\Core\Domain\ValueObject\AggregateIdentifier;
use Acme\MessengerPlayground\User\Domain\ValueObject\Email;
use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use Acme\MessengerPlayground\User\Domain\ValueObject\Password;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;
use DateTimeImmutable;

final class UserRegistered implements DomainEvent
{
    private UserIdentifier $userIdentifier;

    private DateTimeImmutable $occurredOn;

    private Email $email;

    private Password $password;

    public function __construct(
        UserIdentifier $id,
        DateTimeImmutable $occurredOn,
        Email $email,
        Password $password
    ) {
        $this->userIdentifier = $id;
        $this->occurredOn     = $occurredOn;
        $this->email          = $email;
        $this->password   = $password;
    }

    public function aggregateIdentifier(): UserIdentifier
    {
        return $this->userIdentifier;
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }
}
