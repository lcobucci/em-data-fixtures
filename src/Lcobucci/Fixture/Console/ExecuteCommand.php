<?php
namespace Lcobucci\Fixture\Console;

use Doctrine\Fixture\Executor;
use Doctrine\Fixture\Filter\GroupedFilter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Base class for data fixture commands.
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class ExecuteCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('doctrine:fixtures:execute')
             ->setDescription('Import data fixtures to your database.')
             ->addOption('group', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Groups to load data fixtures')
             ->addOption('import', null, InputOption::VALUE_NONE, 'Import data fixtures')
             ->addOption('purge', null, InputOption::VALUE_NONE, 'Purge existing data fixtures');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $helper DataFixtureHelper */
        $helper        = $this->getHelper('data-fixtures');
        $configuration = $helper->getConfiguration();
        $loader        = $helper->getLoader();
        $filter        = $helper->getFilter();
        $flags         = $this->createFlags($input);

        $this->updateFilter($input);

        $executor = new Executor($configuration);
        $executor->execute($loader, $filter, $flags);
    }

    /**
     * Update filter configuration based on provided input.
     *
     * @param InputInterface $input
     */
    protected function updateFilter(InputInterface $input)
    {
        /** @var $helper DataFixtureHelper */
        $helper    = $this->getHelper('data-fixtures');
        $filter    = $helper->getFilter();
        $groupList = $input->getOption('group');

        if (!empty($groupList)) {
            $filter->addFilter(new GroupedFilter($groupList, true));
        }
    }

    /**
     * Create execution flags.
     *
     * @param InputInterface $input
     *
     * @return integer
     */
    protected function createFlags(InputInterface $input)
    {
        $flags = 0;

        if ($input->getOption('import')) {
            $flags |= Executor::IMPORT;
        }

        if ($input->getOption('purge')) {
            $flags |= Executor::PURGE;
        }

        return $flags;
    }
}