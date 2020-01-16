<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Event;

use Acme\MessengerPlayground\User\Domain\ValueObject\Email;
use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use Acme\MessengerPlayground\User\Domain\ValueObject\Password;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;
use DateTimeImmutable;

final class UserRegistered implements Event
{
    private EventIdentifier $identifier;

    private DateTimeImmutable $occurredOn;

    private UserIdentifier $id;

    private Email $email;

    private Password $password;

    public function __construct(
        EventIdentifier $identifier,
        DateTimeImmutable $occurredOn,
        UserIdentifier $id,
        Email $email,
        Password $password
    ) {
        $this->identifier = $identifier;
        $this->occurredOn = $occurredOn;
        $this->id         = $id;
        $this->email      = $email;
        $this->password   = $password;
    }

    public function identifier(): EventIdentifier
    {
        return $this->identifier;
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function id(): UserIdentifier
    {
        return $this->id;
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
