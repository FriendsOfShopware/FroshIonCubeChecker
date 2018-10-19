<?php

/**
 * Class Shopware_Controllers_Backend_IoncubeChecker
 */
class Shopware_Controllers_Backend_IoncubeChecker extends Shopware_Controllers_Backend_ExtJs
{
    public function preDispatch()
    {
        parent::preDispatch();

        $directory = $this->container->getParameter('frosh_ion_cube_checker.plugin_dir') . '/Resources/views';
        $this->View()->addTemplateDir($directory);
    }

    /**
     * @throws \Exception
     */
    public function listAction()
    {
        $limit = (int) $this->Request()->getParam('limit', 20);
        $offset = (int) $this->Request()->getParam('start', 0);

        $ionCubeDetector = $this->container->get('frosh_ion_cube_checker.ion_cube_detector');

        $plugins = $ionCubeDetector->run(null, $limit, $offset);

        $this->View()->assign([
            'success' => true,
            'data' => $plugins,
            'total' => count($plugins),
        ]);
    }
}
