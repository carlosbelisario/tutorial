<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artista
 *
 * @ORM\Table(name="artista")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtistaRepository")
 */
class Artista
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var ArrayCollection<Album>
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Album", inversedBy="artista")
     */
    private $album;


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
     * @return Artista
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
     * Constructor
     */
    public function __construct()
    {
        $this->album = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add album
     *
     * @param \AppBundle\Entity\Album $album
     *
     * @return Artista
     */
    public function addAlbum(\AppBundle\Entity\Album $album)
    {
        $this->album[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param \AppBundle\Entity\Album $album
     */
    public function removeAlbum(\AppBundle\Entity\Album $album)
    {
        $this->album->removeElement($album);
    }

    /**
     * Get album
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
