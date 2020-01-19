<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\Service;

use Acme\MessengerPlayground\User\Domain\ValueObject\UserIdentifier;

interface UserIdentityProvider
{
    public function generate(): UserIdentifier;
}
