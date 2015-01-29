<?php

namespace Entity;

/**
 * @Entity
 * @Table(name="alertas_asignadas")
 */
class AlertaAsignada
{
    /**
     * @ManyToOne(targetEntity="Alerta")
     * @JoinColumn(name="alerta_id", referencedColumnName="id")
     * @Id
     **/
    protected $alerta;

    /**
     * @ManyToOne(targetEntity="Usuario", inversedBy="alertasAsignadas")
     * @JoinColumn(name="usuario_id", referencedColumnName="id")
     * @Id
     **/
    protected $usuario;

    /**
     * @Column(type="datetime", nullable=true)
     */
    protected $visto;

    /**
     * @Column(type="datetime")
     */
    protected $fecha;

    public function __construct($alerta, $usuario)
    {
        $this->alerta = $alerta;
        $this->usuario = $usuario;
        $this->fecha = new \DateTime();
    }

    /**
     * Set visto
     *
     * @param \DateTime $visto
     * @return AlertaUsuario
     */
    public function setVisto(\DateTime $visto)
    {
        $this->visto = $visto;

        return $this;
    }

    /**
     * Get visto
     *
     * @return \DateTime
     */
    public function getVisto()
    {
        return $this->visto;
    }

    /**
     * Set alerta
     *
     * @param \Entity\Alerta $alerta
     * @return AlertaUsuario
     */
    public function setAlerta(Alerta $alerta)
    {
        $this->alerta = $alerta;

        return $this;
    }

    /**
     * Get alerta
     *
     * @return \Entity\Alerta
     */
    public function getAlerta()
    {
        return $this->alerta;
    }

    /**
     * Set usuario
     *
     * @param \Entity\Usuario $usuario
     * @return AlertaUsuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return AlertaUsuario
     */
    public function setFecha(\DateTime $fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    public function toArray()
    {
        return [
            'id' => $this->alerta->getId(),
            'usuario' => $this->usuario->getUsername(),
            'mensaje' => $this->alerta->getMensaje(),
            'link' => $this->alerta->getLink(),
            'visto' => $this->visto ? $this->visto->format("d-m-Y H:i:s") : $this->visto,
            'fecha' => $this->fecha->format("d-m-Y H:i:s")
        ];
    }
}
