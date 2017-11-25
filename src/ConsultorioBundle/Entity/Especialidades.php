<?php

namespace ConsultorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especialidades
 *
 * @ORM\Table(name="ESPECIALIDADES")
 * @ORM\Entity(repositoryClass="ConsultorioBundle\Repository\EspecialidadesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Especialidades
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
     * @return int
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
     * @return Especialidades
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
     * Set isActivo
     *
     * @param boolean $isActivo
     *
     * @return Especialidades
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