<?php


namespace App\Maker;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Twig\Environment;

abstract class AbstractMakeCommand extends Command
{
    /**
     * @var Environment
     */
    private Environment $twig;
    private string $projectDir;

    public function __construct(Environment $twig, string $projectDir)
    {
        parent::__construct();
        $this->twig = $twig;
        $this->projectDir = $projectDir;
    }

    protected function createFile(string $template, array $params, string $output): void
    {
        $content = $this->twig->render("@maker/{$template}.twig", $params);
        $filename = "{$this->projectDir}/{$output}";
        $directory = dirname($filename);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        file_put_contents($filename, $content);
    }

    protected function askClass(string $question, string $pattern, SymfonyStyle $io, bool $multiple = false): array
    {
        $classes = [];
        $paths = explode('/', $pattern);

        if (1 === count($paths)) {
            $directory = "{$this->projectDir}/src";
        } else {
            $directory = "{$this->projectDir}/src/".join('/', array_slice($paths, 0, -1));
            $pattern = join('/', array_slice($paths, -1));
        }
        $files = (new Finder())->in($directory)->name($pattern . '.php')->files();
        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            $filename = str_replace('.php', '', $file->getBasename());
            $classes[$filename] = $file->getPathname();
        }

        $q = new Question($question);
        $q->setAutocompleterValues(array_keys($classes));
        $answers = [];
        $replacements = [
            "{$this->projectDir}/src" => 'App',
            '/' => '\\',
            '.php' => ''
        ];

        while(true) {
            $class = $io->askQuestion($q);
            if (null === $class) {
                return $answers;
            }
            $path = $classes[$class];

            $answers[] = [
                'namespace' => str_replace(array_keys($replacements), array_values($replacements), $path),
                'class_name' => $class
            ];


            if (false === $multiple) {
                return $answers[0];
            }
        }
    }
}