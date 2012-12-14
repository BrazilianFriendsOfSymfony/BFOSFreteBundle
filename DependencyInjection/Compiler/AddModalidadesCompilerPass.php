<?php
 /*
 * This file is part of the Duo Criativa software.
 * Este arquivo é parte do software da Duo Criativa.
 *
 * (c) Paulo Ribeiro <paulo@duocriativa.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BFOS\FreteBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;


class AddModalidadesCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {

        if (false === $container->hasDefinition('bfos_frete.manager')) {
            return;
        }

        $definition = $container->getDefinition('bfos_frete.manager');

        foreach($container->findTaggedServiceIds('bfos_frete.modalidade') as $id=>$attributes){
            $definition->addMethodCall('addModalidade', array(new Reference($id)));
        }

    }

}
