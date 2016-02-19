<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Class AlbumController
 * @package AppBundle\Controller
 * @author Carlos Belisario <carlos.belisario.gonzalez@gmail.com>
 */
class AlbumController extends Controller
{
    /**
     *
     * @Route("/albums", name="albums")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('AppBundle:Album')->findBy([], ['publicadoAt' => 'DESC']);
        return $this->render('album/index.html.twig', array('albums' => $albums));
    }
}
