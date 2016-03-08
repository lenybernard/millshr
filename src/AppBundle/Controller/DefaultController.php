<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $list =[
            [
                'author' => 'Mike',
                'name' => '1 link',
                'url' => 'http://www.google.fr',
                'date' => new \DateTime()
            ],[
                'author' => 'Paulo',
                'name' => '2 link',
                'url' => 'http://www.google.ci',
                'date' => new \DateTime()
            ],[
                'author' => 'Marcel',
                'name' => '3 link',
                'url' => 'http://www.google.eu',
                'date' => new \DateTime()
            ]
        ];
        return $this->render('default/index.html.twig', [
            'list' => $list
        ]);
    }
}
