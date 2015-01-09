<?php

namespace Alerta;

use Silex\Application;
use Entity\Alerta;
use Entity\Usuario;
use Entity\AlertaAsignada;

class AlertaManager
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function getUsuario($username)
    {
        $em = $this->app['orm.em'];
        $usuario = $em->getRepository('Entity\Usuario')->findOneByUsername($username);

        if (!$usuario) {
            $usuario = new Usuario();
            $usuario->setUsername($username);
        }

        return $usuario;
    }

    public function crear($mensaje, $username)
    {
        $em = $this->app['orm.em'];
        $usuario = $this->getUsuario($username);
        $alerta = new Alerta();
        $alerta->setMensaje($mensaje);

        $em->transactional(function ($em) use ($alerta, $usuario) {
            $em->persist($alerta);
            $em->persist($usuario);
            $em->flush();
            $em->persist(new AlertaAsignada($alerta, $usuario));
            $em->flush();
        });
    }

    public function getByUsuario($username)
    {
        $em = $this->app['orm.em'];
        $usuario = $this->getUsuario($username);
        $alertas = $em->getRepository('Entity\AlertaAsignada')->findByUsuario($usuario);

        return array_map(function($alert) { return $alert->toArray(); }, $alertas);
    }
}
