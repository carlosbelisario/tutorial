<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlbumRepository")
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 */
class Album
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicadoAt", type="datetime")
     */
    private $publicadoAt;

    /**
     * @var Artista $artista
     *
     * @ORM\ManyToMany(targetEntity="Artista", mappedBy="album")
     */
    private $artista;


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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Album
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set publicadoAt
     *
     * @param \DateTime $publicadoAt
     *
     * @return Album
     */
    public function setPublicadoAt($publicadoAt)
    {
        $this->publicadoAt = $publicadoAt;

        return $this;
    }

    /**
     * Get publicadoAt
     *
     * @return \DateTime
     */
    public function getPublicadoAt()
    {
        return $this->publicadoAt;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->artista = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add artistum
     *
     * @param \AppBundle\Entity\Artista $artistum
     *
     * @return Album
     */
    public function addArtista(\AppBundle\Entity\Artista $artista)
    {
        $this->artista[] = $artista;

        return $this;
    }

    /**
     * Remove artistum
     *
     * @param \AppBundle\Entity\Artista $artistum
     */
    public function removeArtistum(\AppBundle\Entity\Artista $artista)
    {
        $this->artista->removeElement($artista);
    }

    /**
     * Get artista
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtista()
    {
        return $this->artista;
    }
}
