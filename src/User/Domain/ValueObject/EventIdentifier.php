<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class EventIdentifier
{
    private UuidInterface $value;

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $value): self
    {
        return new self(Uuid::fromString($value));
    }

    private function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value->toString();
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->value->equals($other->value);
    }

    public function __toString(): string
    {
        return $this->value->toString();
    }
}
