<?php

namespace Atournayre\Bundle\AtWorkBundle\Trait\Misc;

trait PlainTextPasswordAccessorsTrait
{
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
