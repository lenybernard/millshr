<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller
{
    /**
     * @Template("default/index.html.twig")
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $links = $this->getDoctrine()->getManager()->getRepository('AppBundle:Link')
            ->findSince(new \DateTime('-3 days'));

        return [
            'links' => $links
        ];
    }
}
