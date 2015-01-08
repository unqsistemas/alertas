<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuario
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(length=140, unique=true)
     */
    protected $username;

    /**
     * @OneToMany(targetEntity="AlertaAsignada", mappedBy="usuario")
     **/
    protected $alertasAsignadas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alertasAsignadas = new ArrayCollection();
    }

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
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Add alertaAsignada
     *
     * @param \Entity\AlertaAsignada $alertasAsignadas
     * @return Usuario
     */
    public function addAlertaAsignada(AlertaAsignada $alertaAsignada)
    {
        $this->alertasAsignadas[] = $alertaAsignada;

        return $this;
    }

    /**
     * Remove alertaAsignada
     *
     * @param \Entity\AlertaAsignada $alertasAsignadas
     */
    public function removeAlertaAsignada(AlertaAsignada $alertaAsignada)
    {
        $this->alertasAsignadas->removeElement($alertaAsignada);
    }

    /**
     * Get alertasAsignadas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlertasAsignadas()
    {
        return $this->alertasAsignadas;
    }
}
