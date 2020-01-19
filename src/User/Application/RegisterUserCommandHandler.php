<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Application;

use Acme\MessengerPlayground\User\Domain\Aggregate\User;
use Acme\MessengerPlayground\Core\Domain\Event\DomainEventBus;
use Acme\MessengerPlayground\User\Domain\Repository\UserRepository;
use Acme\MessengerPlayground\User\Domain\Service\UserIdentityProvider;
use Acme\MessengerPlayground\User\Domain\ValueObject\Email;
use Acme\MessengerPlayground\User\Domain\ValueObject\Password;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;

final class RegisterUserCommandHandler
{
    private UserIdentityProvider $identityProvider;

    private UserRepository $repository;

    private DomainEventBus $eventBus;

    public function __construct(
        UserIdentityProvider $identityProvider,
        UserRepository $repository,
        DomainEventBus $eventBus
    ) {
        $this->identityProvider = $identityProvider;
        $this->repository       = $repository;
        $this->eventBus         = $eventBus;
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $email    = new Email($command->email());
        $password = new Password($command->password());

        $user = User::register(
            $this->identityProvider->generate(),
            $email,
            $password
        );

        $this->repository->save($user);
        $this->eventBus->dispatch(...$user->pullDomainEvents());
    }
}
