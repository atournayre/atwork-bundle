<?php

namespace Atournayre\Bundle\AtworkBundle\Trait\Misc;

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
