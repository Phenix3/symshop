<?php

namespace App\Command;

use Doctrine\Bundle\FixturesBundle\Purger\ORMPurgerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DbPurgeCommand// extends Command
{
   /*
    protected static $defaultName = 'app:db-purge';

    private $purgerFactory;
    private $em;

    public function __construct(ORMPurgerFactory $purgerFactory, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->purgerFactory = $purgerFactory;
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('em', null, InputOption::VALUE_OPTIONAL, 'The Entity Manager to use', 'default')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->note('Your database will be purged');
        $question = $this->ask('Question');
        $io->askQuestion();
        // $arg1 = $input->getArgument('arg1');

        $purger = $this->purgerFactory->createForEntityManager('default', $this->em);
        $purger->purge();

        $io->success('The database has been purged!');

        return Command::SUCCESS;
    } */
}