<?php

namespace Acme\MessengerPlayground\User\Infrastructure\Framework\Controller;

use Acme\MessengerPlayground\User\Application\RegisterUserCommand;
use Acme\MessengerPlayground\User\Application\RegisterUserCommandHandler;
use MongoDB\Driver\Command;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterUserController
{
    private RegisterUserCommandHandler $commandHandler;

    public function __construct(RegisterUserCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;
    }

    /**
     * @Route("/users", name="register_user")
     */
    public function __invoke(RegisterUserCommand $command): Response
    {
        ($this->commandHandler)($command);

        return new Response('', Response::HTTP_ACCEPTED);
    }
}
