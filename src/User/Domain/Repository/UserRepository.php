<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Repository;

use Acme\MessengerPlayground\User\Domain\Aggregate\User;
use Acme\MessengerPlayground\User\Domain\Exception\UserNotFoundException;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;

interface UserRepository
{
    /**
     * @throws UserNotFoundException
     */
    public function get(UserIdentifier $identifier): User;

    public function find(UserIdentifier $identifier): ?User;

    public function save(User $user): void;
}
