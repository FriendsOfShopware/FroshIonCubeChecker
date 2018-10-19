<?php

namespace FroshIonCubeChecker\Components;

use Shopware\Models\Plugin\Plugin;

class IonCubeDetector
{
    const PLUGIN_PATH_CURRENT = 'custom/plugins/';
    const PLUGIN_PATH_LEGACY = 'engine/Shopware/Plugins/';
    const PLUGIN_NAMESPACE_CURRENT = 'ShopwarePlugins';

    const STATUS_ACTIVATED = 'aktiviert';
    const STATUS_DEACTIVATED = 'deaktiviert';
    const STATUS_UNINSTALLED = 'deinstalliert';

    const ION_CUBE_PATTERN = "if(!extension_loaded('ionCube Loader'))";

    /**
     * @var PluginLoader
     */
    private $pluginLoader;

    /**
     * IonCubeDetector constructor.
     *
     * @param PluginLoader $pluginLoader
     */
    public function __construct(PluginLoader $pluginLoader)
    {
        $this->pluginLoader = $pluginLoader;
    }

    /**
     * @param string $filter
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    public function run($filter = null, $limit = null, $offset = null)
    {
        $plugins = $this->pluginLoader->getPlugins($filter);
        $encodedPlugins = [];

        /** @var Plugin $plugin */
        foreach ($plugins as $plugin) {
            $isLegacy = $this->isLegacyPlugin($plugin);
            $path = $this->getPluginPath($plugin, $isLegacy);

            $encoded = $this->scanPlugin($path);

            if (!$encoded) {
                continue;
            }

            $encodedPlugins[] = [
                'name' => $plugin->getName(),
                'label' => $plugin->getLabel(),
                'version' => $plugin->getVersion(),
                'author' => $plugin->getAuthor(),
                'status' => $this->getStatus($plugin),
                'path' => $path,
            ];

            return array_slice($encodedPlugins, $offset, $limit);
        }

        return $encodedPlugins;
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function scanPlugin($path)
    {
        $files = glob($path.'/*.php');

        foreach ($files as $file) {
            if (strpos(file_get_contents($file), self::ION_CUBE_PATTERN) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Plugin $plugin
     *
     * @return bool
     */
    private function isLegacyPlugin(Plugin $plugin)
    {
        return $plugin->getSource() && $plugin->getNamespace() != self::PLUGIN_NAMESPACE_CURRENT;
    }

    /**
     * @param Plugin $plugin
     * @param bool   $isLegacy
     *
     * @return string
     */
    private function getPluginPath(Plugin $plugin, $isLegacy)
    {
        if ($isLegacy) {
            return self::PLUGIN_PATH_LEGACY . $plugin->getSource() . '/' . $plugin->getNamespace() . '/' . $plugin->getName();
        } else {
            return self::PLUGIN_PATH_CURRENT . $plugin->getName();
        }
    }

    /**
     * @param Plugin $plugin
     *
     * @return string
     */
    private function getStatus(Plugin $plugin)
    {
        if ($plugin->getActive()) {
            return self::STATUS_ACTIVATED;
        }

        if ($plugin->getInstalled()) {
            return self::STATUS_DEACTIVATED;
        }

        return self::STATUS_UNINSTALLED;
    }
}
