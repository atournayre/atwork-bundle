<?php

namespace Atournayre\Bundle\AtWorkBundle\Type;

use Atournayre\Assert\Assert;

readonly class EmailAddress
{
    public ?string $email;

    private function __construct(string $email)
    {
        Assert::email($email);

        $this->email = $email;
    }

    public static function fromString(string $email): self
    {
        return new static($email);
    }
}
