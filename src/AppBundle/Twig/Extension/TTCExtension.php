<?php
/**
 * Created by PhpStorm.
 * User: brissetcyprien
 * Date: 08/03/2016
 * Time: 14:47
 */

namespace AppBundle\Twig\Extension;



class TTCExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters ()
    {
        return array(
            new \Twig_SimpleFilter('ttc',array($this, 'calculateprice'))
        );
    }

    /**
     * @
     * @param $price
     * @param int $tva
     * @return mixed
     */
    public function calculateTtc($price, $tva = 20) {
        $priceTtc = $price + (($price * $tva) / 100);

        return $priceTtc;

    }

    /**
     * @return string
     */
    public function getName() {
        return 'ttc';
    }
}