<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Infrastructure\Framework\Controller\ArgumentValueResolver;

use Acme\MessengerPlayground\User\Application\RegisterUserCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RegisterUserCommandArgumentValueResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return RegisterUserCommand::class === $argument->getType()
            && ('users' === $request->get('data')['type'] ?? null);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $data = $request->get('data');

        yield new RegisterUserCommand($data['attributes']['email'], $data['attributes']['password']);
    }
}
