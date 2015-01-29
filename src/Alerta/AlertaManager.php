<?php

namespace Alerta;

use Silex\Application;
use Entity\Alerta;
use Entity\Usuario;
use Entity\AlertaAsignada;

class AlertaManager
{
    protected $app;
    protected $em;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->em = $app['orm.em'];
    }

    protected function getUsuario($username)
    {
        $usuario = $this->em->getRepository('Entity\Usuario')->findOneByUsername($username);

        if (!$usuario) {
            $usuario = new Usuario();
            $usuario->setUsername($username);
        }

        return $usuario;
    }

    public function crear($datos)
    {
        $usuario = $this->getUsuario($datos['usuario']);
        $alerta = new Alerta();
        $alerta->setMensaje($datos['mensaje']);
        $alerta->setLink($datos['link']);

        return $this->em->transactional(function ($em) use ($alerta, $usuario) {
            $em->persist($alerta);
            $em->persist($usuario);
            $em->flush();
            $asignada = new AlertaAsignada($alerta, $usuario);
            $em->persist($asignada);
            $em->flush();

            return $asignada;
        });
    }

    public function marcarVisto($alertasAsignadas)
    {
        if (!is_array($alertasAsignadas)) {
            $alertasAsignadas = array($alertasAsignadas);
        }

        foreach ($alertasAsignadas as $alerta) {
            $alerta->setVisto(new \DateTime());
            $this->em->persist($alerta);
        }
        $this->em->flush();
    }

    public function getByUsuario($username, $alertaIds = array())
    {
        $usuario = $this->getUsuario($username);
        $find = ['usuario' => $usuario];
        if ($alertaIds) {
            $find['alerta'] = $alertaIds;
        }

        return $this->em->getRepository('Entity\AlertaAsignada')->findBy($find, ['fecha' => 'DESC']);
    }

    public function toArray($alertasAsignadas)
    {
        return array_map(function($alert) { return $alert->toArray(); }, $alertasAsignadas);
    }
}
