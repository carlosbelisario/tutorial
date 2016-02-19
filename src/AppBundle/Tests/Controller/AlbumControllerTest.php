<?php


namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use \Prophecy\Argument;

/**
 * Class AlbumControllerTest
 * @package AppBundle\Tests\Controller
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 */
class AlbumControllerTest extends WebTestCase
{
    /**
     * @var Prophet mock object
     */
    private $prophet;

    /**
     *
     * @inheritdoc
     */
    public function setUp()
    {
        $this->prophet = new \Prophecy\Prophet;
    }

    /**
     * Prueba una llamada funcional al controller index con albums cargados
     * @test
     */
    public function testIndex()
    {
        $em = $this->getEntityManagerMock(3);

        $client = static::createClient();
        $client->getContainer()->set('doctrine.orm.default_entity_manager', $em->reveal());
        $crawler = $client->request('GET', '/albums');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );

        $this->assertContains('Albums', $crawler->filter('#container h1')->text());

        $this->assertGreaterThan(
            0,
            $crawler->filter('.album')->count()
        );
    }

    /**
     *
     * prueba una llamada a test index y que no haya albums aun cargados
     * @test
     */
    public function testIndexWithoutAlbum()
    {
        $em = $this->getEntityManagerMock(0);

        $client = static::createClient();
        $client->getContainer()->set('doctrine.orm.default_entity_manager', $em->reveal());
        $crawler = $client->request('GET', '/albums');

        $this->assertContains('No hay album registrado', $crawler->filter('#container')->text());
    }

    /**
     *
     * @param int $cant entero con la cantidad de registros a mostrar
     * @return Mock de el entity manager con los datos que necesitamos para la llamada
     */
    private function getEntityManagerMock($cant)
    {
        $repository = $this->prophesize('Doctrine\ORM\EntityRepository');
        $repository->findBy(Argument::type('array'), Argument::type('array'))
            ->willReturn($this->getAlbumsMock($cant))
        ;

        $em = $this->prophet->prophesize('Doctrine\ORM\EntityManager');
        $em->getRepository(Argument::type('string'))
            ->willReturn($repository->reveal())
            ->shouldBeCalled()
        ;
        $em->clear()->shouldBeCalled();

        return $em;
    }

    /**
     * retorna un array con los datos a retornar del findBy
     * @return array
     */
    private function getAlbumsMock($length)
    {
        $albums = [];
        for ($i = 0; $i < $length; $i++) {
            $albums[] = $this->getAlbumMock($i)->reveal();
        }
        return $albums;
    }

    /**
     * @param $id
     * @return Mock de la entidad album
     */
    private function getAlbumMock($id)
    {
        $artista = $this->prophesize('AppBundle\Entity\Artista');
        $artista->getNombre()
            ->willReturn('Artista 1');
        ;
        $artista->getId()
            ->willReturn(1);
        ;

        $album = $this->prophesize('AppBundle\Entity\Album');
        $album->getTitulo()
            ->willReturn('Album ' . $id)
        ;
        $album->getId()
            ->willReturn($id)
        ;
        $album->getPublicadoAt()
            ->willReturn(new \DateTime())
        ;
        $album->getArtista()
            ->willReturn($artista->reveal())
        ;
        return $album;
    }
}
