<?php

namespace Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class AlertaController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/{username}', [$this, 'alertas']);

        return $controllers;
    }

    public function alertas(Application $app, $username)
    {
        $manager = $app['alerta_manager'];
        $data = $manager->getByUsuario($username);

        return $app->json(array_map(function($alert) { return $alert->toArray(); }, $data));
    }
}
