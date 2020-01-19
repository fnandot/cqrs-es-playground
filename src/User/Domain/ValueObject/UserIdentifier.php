<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\ValueObject;

use Acme\MessengerPlayground\Core\Domain\ValueObject\AggregateIdentifier;

final class UserIdentifier implements AggregateIdentifier
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(AggregateIdentifier $other): bool
    {
        return $other instanceof static
            && $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
