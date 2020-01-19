<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Aggregate;

use Acme\MessengerPlayground\Core\Domain\Aggregate\EventSourcedAggregateRoot;
use Acme\MessengerPlayground\Core\Domain\Event\DomainEvent;
use Acme\MessengerPlayground\Core\Domain\Event\UserRegistered;
use Acme\MessengerPlayground\User\Domain\ValueObject\Email;
use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use Acme\MessengerPlayground\User\Domain\ValueObject\Password;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;
use DateTimeImmutable;

class User extends EventSourcedAggregateRoot
{
    private UserIdentifier $id;

    private Email $email;

    private Password $password;

    public static function register(UserIdentifier $id, Email $email, Password $password): self
    {
        $instance = new static();

        $instance
            ->recordThat(
            new UserRegistered(
                $id,
                new DateTimeImmutable(),
                $email,
                $password
            )
        );

        return $instance;
    }

    private function __construct()
    {
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

    protected function apply(DomainEvent $event): void
    {
        switch (true) {
            case $event instanceof UserRegistered:
                $this->applyUserRegistered($event);
                break;
        }
    }

    private function applyUserRegistered(UserRegistered $userRegistered): void
    {
        $this->id       = $userRegistered->aggregateIdentifier();
        $this->email    = $userRegistered->email();
        $this->password = $userRegistered->password();
    }
}
