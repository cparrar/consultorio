<?php

namespace ConsultorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pacientes
 *
 * @ORM\Table(name="PACIENTES")
 * @ORM\Entity(repositoryClass="ConsultorioBundle\Repository\PacientesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pacientes
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
     * @var int
     *
     * @ORM\Column(name="DOCUMENTO", type="integer")
     */
    private $documento;

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
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_NACIMIENTO", type="datetime")
     */
    private $nacimientoAt;

    /**
     * @var string
     *
     * @ORM\Column(name="CORREO", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREADO", type="datetime")
     */
    private $creadoAt;

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
        $this->creadoAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set documento
     *
     * @param integer $documento
     *
     * @return Pacientes
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return int
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Pacientes
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
     * @return Pacientes
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
     * Set nacimientoAt
     *
     * @param \DateTime $nacimientoAt
     *
     * @return Pacientes
     */
    public function setNacimientoAt($nacimientoAt)
    {
        $this->nacimientoAt = $nacimientoAt;

        return $this;
    }

    /**
     * Get nacimientoAt
     *
     * @return \DateTime
     */
    public function getNacimientoAt()
    {
        return $this->nacimientoAt;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Pacientes
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Pacientes
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Pacientes
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set creadoAt
     *
     * @param \DateTime $creadoAt
     *
     * @return Pacientes
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
     * Set isActivo
     *
     * @param boolean $isActivo
     *
     * @return Pacientes
     */
    public function setIsActivo($isActivo)
    {
        $this->isActivo = $isActivo;

        return $this;
    }

    /**
     * Get isActivo
     *
     * @return bool
     */
    public function getIsActivo()
    {
        return $this->isActivo;
    }
}