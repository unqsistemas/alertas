<?php

namespace Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class AlertaController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->put('/{alerta}/{username}', [$this, 'visto']);
        $controllers->get('/{username}', [$this, 'alertas']);

        return $controllers;
    }

    public function alertas(Application $app, $username)
    {
        $manager = $app['alerta_manager'];
        $alertas = $manager->getByUsuario($username);

        return $app->json($manager->toArray($alertas));
    }

    public function visto(Application $app, Request $request, $alerta, $username)
    {
        $manager = $app['alerta_manager'];
        $alertas = $manager->getByUsuario($username, $alerta);
        $manager->marcarVisto($alertas);

        return $app->json($manager->toArray($alertas));
    }
}
