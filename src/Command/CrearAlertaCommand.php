<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Alerta\AlertaManager;

class CrearAlertaCommand extends Command
{
    protected $alertaManager;

    public function __construct(AlertaManager $alertaManager)
    {
        parent::__construct();

        $this->alertaManager = $alertaManager;
    }

    protected function configure()
    {
        $this
            ->setName('alerta:crear')
            ->setDescription('Crea una nueva alerta')
            ->addArgument('mensaje', InputArgument::REQUIRED, 'Mensaje de la alerta')
            ->addArgument('usuario', InputArgument::REQUIRED, 'Nombre del usuario')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mensaje = $input->getArgument('mensaje');
        $username = $input->getArgument('usuario');

        $this->alertaManager->crear($mensaje, $username);

        $output->writeLn("Se creo la alerta '$mensaje' usuario '$username'");
    }
}
