<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Infrastructure\Domain\Service;

use Acme\MessengerPlayground\User\Domain\Service\UserIdentityProvider;
use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;
use Ramsey\Uuid\Uuid;

final class UuidUserIdentityProvider implements UserIdentityProvider
{
    public function generate(): UserIdentifier
    {
        return new UserIdentifier((string) Uuid::uuid4());
    }
}
