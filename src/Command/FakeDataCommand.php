<?php

namespace Mtt\CatalogBundle\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Mtt\CatalogBundle\Resources\doctrine\fixtures\FixturesGenerator;
use Mtt\CatalogBundle\Resources\doctrine\fixtures\FixturesGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FakeDataCommand extends ContainerAwareCommand
{

    protected $fixtureGenerator;

    protected function configure()
    {
        $this
            ->setName('mtt:catalog:load-fake-data')
            ->setDescription('Creates fake data for dev or test env. Be carefull it will drop all data')
            //->addOption('purge', null, InputOption::VALUE_REQUIRED, 'Not to ask a question about purge', false)
            ->addArgument('purge', InputArgument::OPTIONAL, 'Not to ask a question about purge')
            ->addOption('generator', null, InputOption::VALUE_NONE, 'Use your generator for mtt catalog ')
            ->setHelp(
<<<'EOF'
                        The <info>%command.name%</info> command generates catalog fixtures,
                        If your wont to use your own fixtures then change fixturegenerator - set it with option `generator`, also 
                        your generator must implement FixturesGeneratorInterface.

                        <info>php %command.full_name% --generator=yourbundle/doctrine/fixtureGenerator</info>
EOF
            );;
    }

    protected function getFixturesGenerator(): FixturesGeneratorInterface
    {
        if (null === $this->fixtureGenerator) {
            $this->fixtureGenerator = new FixturesGenerator($this->getContainer());
        }
        return $this->fixtureGenerator;
    }

    /**
     * @param mixed $fixtureGenerator
     */
    public function setFixtureGenerator(FixturesGeneratorInterface $fixtureGenerator)
    {
        $this->fixtureGenerator = $fixtureGenerator;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $argument = $input->getArgument('sure');

        if ($input->getOption('generator')) {
            $this->setFixtureGenerator(new $input->getOption('generator'));
        }

        $output->writeln('You are about to remove all data from mtt_catalog tables and load fake data');

        if ($input->isInteractive() && !$input->getArgument('purge')) {
            if (!$this->askConfirmation($input, $output, '<question>Careful, mtt_catalog data will be purged. Do you want to continue y/N ?</question>', false)) {
                return;
            }
        }
        try {

            $this->getFixturesGenerator()->truncateBundleTables();
            $this->getFixturesGenerator()->loadFakeData(new ArrayCollection());
            $output->writeln('<info>Fake data successfully loaded!</info>');
        } catch (\Throwable $exception) {
            $output->writeln($exception->getMessage());
            $output->writeln('<error>There was error during catelog fixtures load, please fix the error before proceed!</error>');
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param string $question
     * @param bool $default
     *
     * @return bool
     */
    private function askConfirmation(InputInterface $input, OutputInterface $output, $question, $default)
    {
        $questionHelper = $this->getHelperSet()->get('question');
        $question = new ConfirmationQuestion($question, $default);

        return $questionHelper->ask($input, $output, $question);
    }


}
