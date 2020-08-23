<?php

namespace FroshIonCubeChecker\Components;

use Shopware\Models\Plugin\Plugin;

/**
 * Class PluginPathService
 * @package FroshIonCubeChecker\Components
 */
class PluginPathService implements PluginPathServiceInterface
{
    /**
     * @var array
     */
    protected $pluginDirectories;

    /**
     * PluginPathService constructor.
     * @param array $pluginDirectories
     */
    public function __construct(array $pluginDirectories)
    {
        $this->pluginDirectories = $pluginDirectories;
    }

    /**
     * @param Plugin $plugin
     * @return string
     */
    public function create(Plugin $plugin)
    {
        return $this->isLegacyPlugin($plugin)
            ? $this->getPluginPathLegacy($plugin)
            : $this->getPluginPathCurrent($plugin)
        ;
    }

    /**
     * @param Plugin $plugin
     * @return string
     */
    protected function getPluginPathCurrent(Plugin $plugin)
    {
        return $this->pluginDirectories[$plugin->getNamespace()] . $plugin->getName();
    }

    /**
     * @param Plugin $plugin
     * @return string
     */
    protected function getPluginPathLegacy(Plugin $plugin)
    {
        return $this->pluginDirectories[$plugin->getSource()] . $plugin->getNamespace() . '/' . $plugin->getName();
    }

    /**
     * @param Plugin $plugin
     *
     * @return bool
     */
    protected function isLegacyPlugin(Plugin $plugin)
    {
        return $plugin->getSource() && in_array($plugin->getNamespace(), ['Frontend', 'Backend', 'Core']);
    }
}
