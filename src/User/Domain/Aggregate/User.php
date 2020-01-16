<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Aggregate;

use Acme\MessengerPlayground\User\Domain\Event\Event;
use Acme\MessengerPlayground\User\Domain\Event\UserRegistered;
use Acme\MessengerPlayground\User\Domain\ValueObject\Email;
use Acme\MessengerPlayground\User\Domain\ValueObject\EventIdentifier;
use Acme\MessengerPlayground\User\Domain\ValueObject\Password;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;
use DateTimeImmutable;

final class User
{
    private UserIdentifier $id;

    private Email $email;

    private Password $password;

    /** @var Event[] */
    private array $eventStream;

    public static function register(UserIdentifier $id, Email $email, Password $password): self
    {
        $instance = new static();

        $instance
            ->recordThat(
            new UserRegistered(
                EventIdentifier::generate(),
                new DateTimeImmutable(),
                $id,
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

    /**
     * @return Event[]
     */
    public function pullEventStream(): array
    {
        $events = $this->eventStream;
        $this->eventStream = [];

        return $events;
    }

    private function recordThat(Event $event): void
    {
        $this->eventStream[] = $event;

        $this->apply($event);
    }

    private function apply(Event $event): void
    {
        switch (true) {
            case $event instanceof UserRegistered:
                $this->applyUserRegistered($event);
                break;
        }
    }

    private function applyUserRegistered(UserRegistered $userRegistered): void
    {
        $this->id       = $userRegistered->id();
        $this->email    = $userRegistered->email();
        $this->password = $userRegistered->password();
    }
}
