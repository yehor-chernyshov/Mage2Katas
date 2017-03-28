<?php
namespace ProjectEight\ServiceContractsExampleTestBed\Command;

use ProjectEight\ServiceContractsExample\Api\BeefburgerRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServiceContractsExampleTestBed extends Command
{
    /**
     * Object Manager
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * ServiceContractsExampleTestBed constructor.
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Framework\App\State              $appState
     * @param null                                      $name
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\State $appState,
        $name = null
    ) {
        $this->objectManager = $objectManager;
        $appState->setAreaCode('frontend');
        parent::__construct($name);
    }

    /**
     * Configure command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName("project8:service-contracts:test-bed");
        $this->setDescription("Test Bed for running various commands");
        parent::configure();
    }

    /**
     * Test all major functions of Beefburger service contract (loading, saving, deleting)
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var BeefburgerRepositoryInterface $repository */
        $repository = $this->objectManager->get(
            \ProjectEight\ServiceContractsExample\Model\BeefburgerRepository::class
        );
        $beefburger = $this->objectManager->get(\ProjectEight\ServiceContractsExample\Model\Beefburger::class);

        $output->writeln("Creating new beefburger...");
        $beefburger->setName('The Big Cheese');
        $output->writeln($beefburger->getData());

        $output->writeln("Saving beefburger...");
        $repository->save($beefburger);

        $beefburgerId = is_object($beefburger) ? $beefburger->getId() : 1;

        $output->writeln("Loading beefburger {$beefburgerId}...");
        $beefburger = $repository->getById($beefburgerId);
        $output->writeln($beefburger->getData());

        $output->writeln("Deleting beefburger {$beefburgerId}...");
        $beefburger = $repository->deleteById($beefburgerId);
        $output->writeln(
            $beefburger == true ? "Deleted beefburger {$beefburgerId}" : "Could not delete {$beefburgerId}"
        );

        $output->writeln("All done.");
    }
}
