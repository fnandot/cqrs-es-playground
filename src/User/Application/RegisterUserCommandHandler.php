<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Application;

use Acme\MessengerPlayground\User\Domain\Aggregate\User;
use Acme\MessengerPlayground\Core\Domain\Event\DomainEventBus;
use Acme\MessengerPlayground\User\Domain\Repository\UserRepository;
use Acme\MessengerPlayground\User\Domain\ValueObject\Email;
use Acme\MessengerPlayground\User\Domain\ValueObject\Password;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;

final class RegisterUserCommandHandler
{
    private UserRepository $repository;

    private DomainEventBus $eventBus;

    public function __construct(UserRepository $repository, DomainEventBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus   = $eventBus;
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $email    = new Email($command->email());
        $password = new Password($command->password());

        $user = User::register(
            UserIdentifier::generate(),
            $email,
            $password
        );

        $this->repository->save($user);
        $this->eventBus->dispatch(...$user->pullDomainEvents());
    }
}
