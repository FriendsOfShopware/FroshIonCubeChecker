<?php

namespace FroshIonCubeChecker\Commands;

use FroshIonCubeChecker\Components\IonCubeDetector;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Shopware\Commands\ShopwareCommand;

class IonCube extends ShopwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sw:plugin:ioncube')
            ->setDescription('Show ionCube encoded plugins.')
            ->addOption(
                'filter',
                'f',
                InputOption::VALUE_REQUIRED,
                'Filter Plugins (inactive, active, installed, uninstalled)'
            )
            ->setHelp(
                <<<EOF
The <info>%command.name%</info> list ionCube encoded plugins.
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filter = strtolower($input->getOption('filter'));

        /** @var IonCubeDetector $detector */
        $detector = $this->container->get('frosh_ion_cube_checker.ion_cube_detector');

        $plugins = $detector->run($filter);

        $table = new Table($output);
        $table->setHeaders(['Plugin', 'Label', 'Version', 'Author', 'Status', 'Pfad']);
        $table->setRows($plugins);
        $table->render();
    }
}
