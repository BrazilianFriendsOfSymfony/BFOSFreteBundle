<?php

namespace BFOS\FreteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use BFOS\FreteBundle\DependencyInjection\Compiler\AddModalidadesCompilerPass;

class BFOSFreteBundle extends Bundle
{
    public function build(\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddModalidadesCompilerPass());
    }
}
