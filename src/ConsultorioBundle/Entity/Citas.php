<?php

namespace ConsultorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Citas
 *
 * @ORM\Table(name="CITAS", indexes={
 *     @ORM\Index(name="IDX_CITAS_COLUMN_PACIENTE", columns={"PACIENTE"}),
 *     @ORM\Index(name="IDX_CITAS_COLUMN_MEDICO", columns={"MEDICO"})
 * })
 * @ORM\Entity(repositoryClass="ConsultorioBundle\Repository\CitasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Citas
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
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CITA", type="datetime")
     */
    private $fechaAt;

    /**
     * @var \ConsultorioBundle\Entity\Pacientes
     *
     * @ORM\ManyToOne(targetEntity="ConsultorioBundle\Entity\Pacientes")
     * @ORM\JoinColumn(name="PACIENTE", referencedColumnName="ID")
     */
    private $paciente;

    /**
     * @var \ConsultorioBundle\Entity\Medicos
     *
     * @ORM\ManyToOne(targetEntity="ConsultorioBundle\Entity\Medicos")
     * @ORM\JoinColumn(name="MEDICO", referencedColumnName="ID")
     */
    private $medico;

    /**
     * @var string
     *
     * @ORM\Column(name="PRECIO", type="string", length=255)
     */
    private $precio;

    /**
     * @var bool
     *
     * @ORM\Column(name="ESTADO", type="boolean")
     */
    private $isActivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="datetime")
     */
    private $creadoAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ACTUALIZADO", type="datetime")
     */
    private $actualizadoAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="ASISTENCIA", type="boolean")
     */
    private $isAsistencia;

    /**
     * @ORM\PrePersist()
     */
    public function setPrePersistData() {
        $this->isActivo = true;
        $this->creadoAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setPreUpdateData() {
        $this->actualizadoAt = new \DateTime();
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
     * Set fechaAt
     *
     * @param \DateTime $fechaAt
     *
     * @return Citas
     */
    public function setFechaAt($fechaAt)
    {
        $this->fechaAt = $fechaAt;

        return $this;
    }

    /**
     * Get fechaAt
     *
     * @return \DateTime
     */
    public function getFechaAt()
    {
        return $this->fechaAt;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Citas
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set isActivo
     *
     * @param boolean $isActivo
     *
     * @return Citas
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
     * Set creadoAt
     *
     * @param \DateTime $creadoAt
     *
     * @return Citas
     */
    public function setCreadoAt($creadoAt)
    {
        $this->creadoAt = $creadoAt;

        return $this;
    }

    /**
     * Get creadoAt
     *
     * @return \DateTime
     */
    public function getCreadoAt()
    {
        return $this->creadoAt;
    }

    /**
     * Set actualizadoAt
     *
     * @param \DateTime $actualizadoAt
     *
     * @return Citas
     */
    public function setActualizadoAt($actualizadoAt)
    {
        $this->actualizadoAt = $actualizadoAt;

        return $this;
    }

    /**
     * Get actualizadoAt
     *
     * @return \DateTime
     */
    public function getActualizadoAt()
    {
        return $this->actualizadoAt;
    }

    /**
     * Set isAsistencia
     *
     * @param boolean $isAsistencia
     *
     * @return Citas
     */
    public function setIsAsistencia($isAsistencia)
    {
        $this->isAsistencia = $isAsistencia;

        return $this;
    }

    /**
     * Get isAsistencia
     *
     * @return boolean
     */
    public function getIsAsistencia()
    {
        return $this->isAsistencia;
    }

    /**
     * Set paciente
     *
     * @param \ConsultorioBundle\Entity\Pacientes $paciente
     *
     * @return Citas
     */
    public function setPaciente(\ConsultorioBundle\Entity\Pacientes $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \ConsultorioBundle\Entity\Pacientes
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set medico
     *
     * @param \ConsultorioBundle\Entity\Medicos $medico
     *
     * @return Citas
     */
    public function setMedico(\ConsultorioBundle\Entity\Medicos $medico = null)
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * Get medico
     *
     * @return \ConsultorioBundle\Entity\Medicos
     */
    public function getMedico()
    {
        return $this->medico;
    }
}