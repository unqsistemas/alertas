<?php

namespace Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class AlertaController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', [$this, 'alertas']);

        return $controllers;
    }

    public function alertas(Application $app)
    {
        $em = $app['orm.em'];
        $data = $em->getRepository('Entity\Alerta')->findAll();

        return $app->json($data);
    }
}
