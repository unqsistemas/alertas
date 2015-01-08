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
     * @Column(type="boolean")
     */
    protected $visto;

    /**
     * Set visto
     *
     * @param boolean $visto
     * @return AlertaUsuario
     */
    public function setVisto($visto)
    {
        $this->visto = $visto;

        return $this;
    }

    /**
     * Get visto
     *
     * @return boolean
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
}
