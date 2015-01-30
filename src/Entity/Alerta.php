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
     * @Column(type="string", nullable=true, unique=true)
     */
    protected $codigo;

    /**
     * @Column(type="text")
     */
    protected $mensaje;

    /**
     * @Column(type="string", nullable=true)
     */
    protected $link;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getCodigo()
    {
        return $this->codigo;
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

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function toArray()
    {
        return ['id' => $this->id, 'mensaje' => $this->mensaje];
    }
}
