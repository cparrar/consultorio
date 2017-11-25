<?php

    namespace ConsultorioBundle\Command;

    use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
    use Symfony\Component\Console\Input\ArrayInput;
    use Symfony\Component\Console\Input\InputArgument;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Input\InputOption;
    use Symfony\Component\Console\Output\OutputInterface;
    use Symfony\Component\Console\Style\SymfonyStyle;

    /**
     * Class ZyosInstallCommand
     *
     * @package ConsultorioBundle\Command
     */
    class ZyosInstallCommand extends ContainerAwareCommand {

        /**
         * configure()
         */
        protected function configure() {
            $this->setName('zyos:install')->setDescription('Instalación de base de datos y otros datos demo');
        }

        /**
         * @param InputInterface $input
         * @param OutputInterface $output
         * @return int|null|void
         */
        protected function execute(InputInterface $input, OutputInterface $output) {

            $io = new SymfonyStyle($input, $output);
            $io->title('Instalación de Datos');

            $io->newLine(2);
            $io->section('Instalacion de Base de datos');
            $this->executeCommandLine($output, 'doctrine:database:drop', ['--if-exists' => true, '--force' => true]);
            $this->executeCommandLine($output, 'doctrine:database:create', ['--if-not-exists' => true]);

            $io->newLine(2);
            $io->section('Creando Esquema de la base de datos');
            $this->executeCommandLine($output, 'doctrine:schema:update', ['--force' => true]);

            $io->newLine(2);
            $io->section('Cargando Datos Demo');
            $this->executeCommandLine($output, 'doctrine:fixtures:load', ['--append' => true]);

            $io->newLine(2);
            $io->success('Instalación Finalizada');
        }

        /**
         * @param OutputInterface $output
         * @param null $command
         * @param array $params
         */
        private function executeCommandLine(OutputInterface $output, $command = null, $params = []) {

            $command = $this->getApplication()->find($command);

            $arguments['command'] = $command;
            $arguments = array_merge($arguments, $params);

            $arrayInput = new ArrayInput($arguments);
            $returnCode = $command->run($arrayInput, $output);
        }
    }