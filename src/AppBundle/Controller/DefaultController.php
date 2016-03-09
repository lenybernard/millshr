<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     * @Template("default/index.html.twig")
     */
    public function indexAction(Request $request)
    {

       $list  = $this->getDoctrine()->getManager()->getRepository('AppBundle:Link')
           ->findSince(new \DateTime('-3 days'));

        return [
            'list' => $list
        ];
    }
}
