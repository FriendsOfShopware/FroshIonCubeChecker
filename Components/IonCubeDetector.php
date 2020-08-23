<?php

namespace FroshIonCubeChecker\Components;

use Shopware\Models\Plugin\Plugin;

class IonCubeDetector
{


    const STATUS_ACTIVATED = 'aktiviert';
    const STATUS_DEACTIVATED = 'deaktiviert';
    const STATUS_UNINSTALLED = 'deinstalliert';

    const ION_CUBE_PATTERN = "if(!extension_loaded('ionCube Loader'))";

    /**
     * @var PluginLoader
     */
    private $pluginLoader;

    protected $pluginPathService;

    /**
     * IonCubeDetector constructor.
     *
     * @param PluginLoader $pluginLoader
     * @param PluginPathServiceInterface $pluginPathService
     */
    public function __construct(PluginLoader $pluginLoader, PluginPathServiceInterface $pluginPathService)
    {
        $this->pluginLoader = $pluginLoader;
        $this->pluginPathService = $pluginPathService;
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
            $path = $this->pluginPathService->create($plugin);

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
        }

        return array_slice($encodedPlugins, $offset, $limit);
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
