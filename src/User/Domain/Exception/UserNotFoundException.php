<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Exception;

use Acme\MessengerPlayground\Core\Domain\Exception\DomainException;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;
use Throwable;

final class UserNotFoundException extends DomainException
{
    public function __construct(UserIdentifier $userIdentifier, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('User identified with "%s" could not be found', $userIdentifier),
            404,
            $previous
        );
    }

}
