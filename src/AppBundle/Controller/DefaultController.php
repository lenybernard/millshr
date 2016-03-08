<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $items = [
            [
                'author' => 'Mike',
                'name' => 'my link',
                'url' => 'http://mylink',
                'createdAt' => new \DateTime(),
            ],
            [
                'author' => 'Samantha',
                'name' => 'my awesome link',
                'url' => 'http://myawesomelink',
                'createdAt' => new \DateTime(),
            ],
            [
                'author' => 'Brandon',
                'name' => 'my poor link',
                'url' => 'http://mypoorlink',
                'createdAt' => new \DateTime(),
            ]
        ];
        shuffle($items);

        return $this->render('default/index.html.twig', [
            'links' => $items
        ]);
    }
}
