<?php

declare(strict_types = 1);

namespace Acme\MessengerPlayground\User\Application;

final class RegisterUserCommand
{
    private string $email;

    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
