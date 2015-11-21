<?php

namespace JonasDeKeukelaere\Money\tests;

use JonasDeKeukelaere\Money\Currency;
use JonasDeKeukelaere\Money\Money;

/**
 * Class MoneyTest.php
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $currency = new Currency('EUR');
        $money = new Money(100, $currency);

        $this->assertEquals(100, $money->getAmount());
        $this->assertEquals($currency, $money->getCurrency());
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidAmountException
     */
    public function testCannotBeConstructedWithStringAmount()
    {
        new Money('abc', new Currency('EUR'));
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidAmountException
     */
    public function testCannotBeConstructedWithNullAmount()
    {
        new Money(null, new Currency('EUR'));
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidAmountException
     */
    public function testCannotBeConstructedWithFloatAmount()
    {
        new Money(5.5, new Currency('EUR'));
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testCannotBeConstructedWithInvalidCurrencyArgument()
    {
        new Money(100, null);
    }
}
