<?php

namespace Atournayre\Bundle\AtWorkBundle;

use Atournayre\Bundle\AtWorkBundle\DependencyInjection\AtWorkExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AtworkBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new AtWorkExtension();
        }
        return $this->extension;
    }
}
