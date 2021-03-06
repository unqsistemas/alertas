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

        $controllers->put('/alertas/{alerta}/visto/{username}', [$this, 'visto']);
        $controllers->post('/alertas', [$this, 'nueva']);
        $controllers->get('/usuarios/{username}/alertas', [$this, 'alertas']);

        return $controllers;
    }

    public function alertas(Application $app, $username)
    {
        $manager = $app['alerta_manager'];
        $alertas = $manager->getByUsuario($username);

        return $app->json($manager->toArray($alertas));
    }

    public function nueva(Application $app, Request $request)
    {
        $manager = $app['alerta_manager'];
        $datos = array();
        $datos['mensaje'] = $request->get('mensaje');
        $datos['usuario'] = $request->get('usuario');
        $datos['link'] = $request->get('link');
        $datos['codigo'] = $request->get('codigo');

        $alerta = $manager->crear($datos);

        return $app->json($alerta->toArray());
    }

    public function visto(Application $app, Request $request, $alerta, $username)
    {
        $manager = $app['alerta_manager'];
        $alertas = $manager->getByUsuario($username, $alerta);
        $manager->marcarVisto($alertas);

        return $app->json($manager->toArray($alertas));
    }
}
