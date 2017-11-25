<?php

namespace ConsultorioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultorios
 *
 * @ORM\Table(name="CONSULTORIOS")
 * @ORM\Entity(repositoryClass="ConsultorioBundle\Repository\ConsultoriosRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Consultorios
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
     * @return Consultorios
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
     * @return Consultorios
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