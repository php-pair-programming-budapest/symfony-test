<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/valami", name="valami")
     */
    public function valamiAction()
    {
        $latestTen = $this->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:User')->getLatestTen();
        $firstTen = $this->_getRepository('AppBundle:User')->getFirstTen();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        return new Response(
            $serializer->serialize($latestTen, 'json')
            . '<hr>' .
            $serializer->serialize($firstTen, 'json')
        );
        // return new Response('valami');
        // return $this->json(['hello' => 'world']);
    }
}
