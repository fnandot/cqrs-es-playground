<?php

declare(strict_types = 1);


namespace Acme\MessengerPlayground\Core\Domain\ValueObject;


interface AggregateIdentifier
{
    public function toString(): string;

    public function equals(AggregateIdentifier $other): bool;
}
