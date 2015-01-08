<?php

namespace Alerta;

use Silex\Application;
use Entity\Alerta;

class AlertaManager
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function crear($mensaje, $username)
    {
        $em = $this->app['orm.em'];

        $alerta = new Alerta();
        $alerta->setMensaje($mensaje);

        $em->persist($alerta);
        $em->flush();
    }
}
