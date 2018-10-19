<?php

namespace FroshIonCubeChecker;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Shopware-Plugin FroshIonCubeChecker.
 */
class FroshIonCubeChecker extends Plugin
{
    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('frosh_ion_cube_checker.plugin_dir', $this->getPath());
        parent::build($container);
    }
}
