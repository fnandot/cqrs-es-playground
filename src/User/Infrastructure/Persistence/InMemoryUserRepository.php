<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Infrastructure\Persistence;

use Acme\MessengerPlayground\User\Domain\Aggregate\User;
use Acme\MessengerPlayground\User\Domain\Exception\UserNotFoundException;
use Acme\MessengerPlayground\User\Domain\Repository\UserRepository;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;

final class InMemoryUserRepository implements UserRepository
{
    /** @var User[] */
    private array $instances;

    public function get(UserIdentifier $identifier): User
    {
        $user = $this->find($identifier);

        if (null !== $user) {
            return $user;
        }

        throw new UserNotFoundException($identifier);
    }

    public function find(UserIdentifier $identifier): ?User
    {
        return $this->instances[(string) $identifier] ?? null;
    }

    public function save(User $user): void
    {
        $this->instances[(string) $user->id()] = $user;
    }
}
