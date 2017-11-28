<?php

namespace ConsultorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicos
 *
 * @ORM\Table(name="MEDICOS", indexes={
 *     @ORM\Index(name="IDX_MEDICOS_COLUMN_ESPECIALIDAD", columns={"ESPECIALIDAD"})
 * })
 * @ORM\Entity(repositoryClass="ConsultorioBundle\Repository\MedicosRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Medicos
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDO", type="string", length=255)
     */
    private $apellido;

    /**
     * @var \ConsultorioBundle\Entity\Especialidades
     *
     * @ORM\ManyToOne(targetEntity="ConsultorioBundle\Entity\Especialidades")
     * @ORM\JoinColumn(name="ESPECIALIDAD", referencedColumnName="ID")
     */
    private $especialidad;

    /**
     * @var \ConsultorioBundle\Entity\Consultorios
     *
     * @ORM\ManyToOne(targetEntity="ConsultorioBundle\Entity\Consultorios")
     * @ORM\JoinColumn(name="CONSULTORIO", referencedColumnName="ID", nullable=true)
     */
    private $consultorio;

    /**
     * @var bool
     *
     * @ORM\Column(name="ESTADO", type="boolean")
     */
    private $isActivo;

    /**
     * @ORM\PrePersist()
     */
    public function setPrePersistData() {

        $this->isActivo = true;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Medicos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Medicos
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set isActivo
     *
     * @param boolean $isActivo
     *
     * @return Medicos
     */
    public function setIsActivo($isActivo)
    {
        $this->isActivo = $isActivo;

        return $this;
    }

    /**
     * Get isActivo
     *
     * @return boolean
     */
    public function getIsActivo()
    {
        return $this->isActivo;
    }

    /**
     * Set especialidad
     *
     * @param \ConsultorioBundle\Entity\Especialidades $especialidad
     *
     * @return Medicos
     */
    public function setEspecialidad(\ConsultorioBundle\Entity\Especialidades $especialidad = null)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return \ConsultorioBundle\Entity\Especialidades
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set consultorio
     *
     * @param \ConsultorioBundle\Entity\Consultorios $consultorio
     *
     * @return Medicos
     */
    public function setConsultorio(\ConsultorioBundle\Entity\Consultorios $consultorio = null)
    {
        $this->consultorio = $consultorio;

        return $this;
    }

    /**
     * Get consultorio
     *
     * @return \ConsultorioBundle\Entity\Consultorios
     */
    public function getConsultorio()
    {
        return $this->consultorio;
    }
}
