<?php
namespace AppBundle\Tests\Entity;

use \PHPUnit_Framework_TestCase as TestCase;
use AppBundle\Entity\Album;
use AppBundle\Entity\Artista;

/**
 * Class AlbumTest
 * @package AppBundle\Tests\Entity
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 */
class AlbumTest extends TestCase
{
    /**
     * @var Album $album
     */
    private $album;
    /**
     *
     * prueba la existencia e instancia de un nuevo objeto tipo Album
     * @test
     */
    public function testAlbumInitialCount()
    {
        $this->assertEquals(1, count($this->album));
    }

    /**
     * probamos el poder agregar artistas al album
     * @test
     */
    public function testAddArtista()
    {
        $this->album->AddArtista(new Artista());
        $this->album->AddArtista(new Artista());
        $this->album->AddArtista(new Artista());
        $this->assertEquals(3, count($this->album->getArtista()));
    }

    /**
     *
     * probamos que se puedan remover los artistas
     * @test
     */
    public function testRemoveArtista()
    {
        $this->album->AddArtista(new Artista());
        $artista2 = new Artista();
        $this->album->AddArtista($artista2);
        $this->album->AddArtista(new Artista());
        $this->album->removeArtistum($artista2);
        $this->assertEquals(2, count($this->album->getArtista()));
    }

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->album = new Album();
    }
}
