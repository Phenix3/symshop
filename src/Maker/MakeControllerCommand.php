<?php


namespace App\Maker;


use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeControllerCommand extends AbstractMakeCommand
{

    protected static $defaultName = 'do:controller';

    protected function configure(): void
    {
        $this
            ->setDescription('Permet de creer un controller d\'admin')
            ->addArgument('controllerName', InputArgument::OPTIONAL, 'Nom du contolleur')
            ->addOption('api', null, InputOption::VALUE_NONE, 'Generer un controller pour l\'API')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        /** @var string $controllerPath */
        $controllerPath = $input->getArgument('controllerName');
        if ('Controller' !== substr($controllerPath, -1, strlen('Controller'))) {
            $controllerPath .= 'Controller';
        }
        if (!is_string($controllerPath)) {
            throw new RuntimeException('controllerPath doit etre une chaine de caractere');
        }
        $parts = explode('/', $controllerPath);
        if (1 === count($parts)) {
            $namespace = '';
            $className = $parts[0];
        } else {
            $namespace = '\\'.implode('\\', array_slice($parts, 0, -1));
            $className = $parts[count($parts) - 1];
        }

        $api = $input->getOption('api');

        $basePath = false === $api ? 'src/Admin/Controller/' : 'src/Admin/Api/Controller/';

        $params = [
            'namespace' => $namespace,
            'class_name' => $className,
            'api' => $api
        ];

        $this->createFile('controller', $params, "{$basePath}{$controllerPath}.php");
        $this->createFile('controller.test', $params, str_replace('src/', 'tests/', $basePath)."{$controllerPath}.php");

        $io->success('Le controller a bien ete cree');

        return Command::SUCCESS;
    }

}