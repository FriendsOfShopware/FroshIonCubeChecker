<?php

namespace FroshIonCubeChecker\Subscriber;

use Enlight\Event\SubscriberInterface;

class ControllerPath implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginDir;

    /**
     * ControllerPathSubscriber constructor.
     *
     * @param $pluginDir
     */
    public function __construct($pluginDir)
    {
        $this->pluginDir = $pluginDir;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_IoncubeChecker' => 'onIoncubeCheckerController',
        ];
    }

    public function onIoncubeCheckerController()
    {
        return $this->pluginDir . '/Controllers/Backend/IoncubeChecker.php';
    }
}
