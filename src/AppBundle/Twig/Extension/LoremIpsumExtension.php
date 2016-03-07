<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Api\LoremApi;

class LoremIpsumExtension extends \Twig_Extension
{
    protected $loremApi;

    /**
     * LoremApi $loremApi
     *
     * @param LoremApi $loremApi
     */
    public function __construct(LoremApi $loremApi)
    {
        $this->loremApi = $loremApi;
    }
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('lorem', [$this, 'loremFunction'], [
                'is_safe'           => ['html'],
                'needs_environment' => true,
            ])
        );
    }

    /**
     * @param        $env
     * @param string $type
     * @param int    $paragraphNumber
     *
     * @return string
     */
    public function loremFunction($env, $type = 'meat-and-filler', $paragraphNumber = 1)
    {
        $response = '<p>'.implode('</p><p>', $this->loremApi->generate($type, $paragraphNumber)).'</p>';
        $twig = new \Twig_Environment(new \Twig_Loader_Array(['response' => $response]));

        return $twig->render('response');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'lorem_ipsum';
    }
}
