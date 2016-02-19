<?php


namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Album;
use AppBundle\Entity\Artista;

/**
 * Class ArtistaTest
 * @package AppBundle\Tests\Entity
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 */
class ArtistaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Artista $album
     */
    private $artista;
    /**
     *
     * prueba la existencia e instancia de un nuevo objeto tipo Artista
     * @test
     */
    public function testArtistaInitialCount()
    {
        $this->assertEquals(1, count($this->artista));
    }

    /**
     * probamos el poder agregar albums al Artista
     * @test
     */
    public function testAddArtista()
    {
        $this->artista->addAlbum(new Album());
        $this->artista->addAlbum(new Album());
        $this->artista->addAlbum(new Album());

        $this->assertEquals(3, count($this->artista->getAlbum()));
    }

    /**
     *
     * probamos que se puedan remover los albums
     * @test
     */
    public function testRemoveAlbum()
    {
        $this->artista->addAlbum(new Album());
        $album2 = new Album();
        $this->artista->addAlbum($album2);
        $this->artista->addAlbum(new Album());
        $this->artista->removeAlbum($album2);
        $this->assertEquals(2, count($this->artista->getAlbum()));
    }

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->artista = new Artista();
    }
}
