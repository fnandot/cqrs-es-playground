<?php

namespace Acme\MessengerPlayground\User\Infrastructure\Framework\Controller;

use Acme\MessengerPlayground\User\Application\RegisterUserCommand;
use Acme\MessengerPlayground\User\Application\RegisterUserCommandHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterUserController
{
    /**
     * @Route("/users", name="register", methods={"POST"})
     */
    public function __invoke(RegisterUserCommand $command, RegisterUserCommandHandler $handle): Response
    {
        $handle($command);

        return Response::create(null, Response::HTTP_ACCEPTED);
    }
}
