<?php

namespace FroshIonCubeChecker\Components;

use Shopware\Components\Model\ModelManager;

class PluginLoader
{
    /**
     * @var ModelManager
     */
    private $modelManager;

    public function __construct(ModelManager $modelManager)
    {
        $this->modelManager = $modelManager;
    }

    /**
     * @param string $filter
     *
     * @return array
     */
    public function getPlugins($filter = null)
    {
        $repository = $this->modelManager->getRepository(\Shopware\Models\Plugin\Plugin::class);

        $builder = $repository->createQueryBuilder('plugin');
        $builder->andWhere('plugin.capabilityEnable = true');
        $builder->addOrderBy('plugin.active', 'desc');
        $builder->addOrderBy('plugin.name');

        if ($filter === 'active') {
            $builder->andWhere('plugin.active = true');
        }

        if ($filter === 'inactive') {
            $builder->andWhere('plugin.active = false');
        }

        if ($filter === 'installed') {
            $builder->andWhere('plugin.installed is not NULL');
        }

        if ($filter === 'uninstalled') {
            $builder->andWhere('plugin.installed is NULL');
        }

        $plugins = $builder->getQuery()->execute();

        return $plugins;
    }
}
