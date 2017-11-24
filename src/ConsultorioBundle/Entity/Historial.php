<?php

namespace ConsultorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historial
 *
 * @ORM\Table(name="HISTORIAL", indexes={@ORM\Index(name="IDX_HISTORIAL_CITA", columns={"CITA"})})
 * @ORM\Entity(repositoryClass="ConsultorioBundle\Repository\HistorialRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Historial
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
     * @var \ConsultorioBundle\Entity\Citas
     *
     * @ORM\OneToOne(targetEntity="ConsultorioBundle\Entity\Citas")
     * @ORM\JoinColumn(name="CITA", referencedColumnName="ID")
     */
    private $cita;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO", type="text")
     */
    private $motivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONSULTA", type="datetime")
     */
    private $fechaAt;

    /**
     * @ORM\PrePersist()
     */
    public function setPrePersist() {
        $this->fechaAt = new \DateTime();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Historial
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set motivo
     *
     * @param string $motivo
     *
     * @return Historial
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return string
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set fechaAt
     *
     * @param \DateTime $fechaAt
     *
     * @return Historial
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
     * Set cita
     *
     * @param \ConsultorioBundle\Entity\Citas $cita
     *
     * @return Historial
     */
    public function setCita(\ConsultorioBundle\Entity\Citas $cita = null)
    {
        $this->cita = $cita;

        return $this;
    }

    /**
     * Get cita
     *
     * @return \ConsultorioBundle\Entity\Citas
     */
    public function getCita()
    {
        return $this->cita;
    }
}