<?php

namespace FroshIonCubeChecker\Components;

use Shopware\Models\Plugin\Plugin;

/**
 * Interface PluginPathServiceInterface
 * @package FroshIonCubeChecker\Components
 */
interface PluginPathServiceInterface
{
    /**
     * @param Plugin $plugin
     * @return string
     */
    public function create(Plugin $plugin);
}
