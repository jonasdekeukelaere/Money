<?php

namespace JonasDeKeukelaere\Money\tests;

use JonasDeKeukelaere\Money\Currency;

/**
 * Class CurrencyTest.php
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $currency = new Currency('EUR');

        $this->assertEquals('EUR', $currency->getCode());
    }
}
