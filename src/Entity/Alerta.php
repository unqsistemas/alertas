<?php

namespace Entity;

/**
 * @Entity
 * @Table(name="alertas")
 */
class Alerta
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="text")
     */
    protected $mensaje;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return Alerta
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function toArray()
    {
        return ['id' => $this->id, 'mensaje' => $this->mensaje];
    }
}
