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

    public function testAnotherMoneyObjectWithSameCurrencyCanBeAdded()
    {
        $money1 = new Money(100, new Currency('EUR'));
        $money2 = new Money(200, new Currency('EUR'));

        $this->assertEquals(300, $money1->add($money2)->getAmount());
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\CurrencyMismatchException
     */
    public function testCannotAddAnotherMoneyObjectWithDifferentCurrency()
    {
        $money1 = new Money(100, new Currency('EUR'));
        $money2 = new Money(200, new Currency('GPB'));

        $money1->add($money2);
    }

    public function testAnotherMoneyObjectWithSameCurrencyCanBeSubtracted()
    {
        $money1 = new Money(300, new Currency('EUR'));
        $money2 = new Money(200, new Currency('EUR'));

        $this->assertEquals(100, $money1->subtract($money2)->getAmount());
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\CurrencyMismatchException
     */
    public function testCannotSubtractAnotherMoneyObjectWithDifferentCurrency()
    {
        $money1 = new Money(300, new Currency('EUR'));
        $money2 = new Money(200, new Currency('GBP'));

        $money1->subtract($money2)->getAmount();
    }

    public function testMoneyWithSameCurrencyCanBeCompared()
    {
        $money1 = new Money(100, new Currency('EUR'));
        $money2 = new Money(100, new Currency('EUR'));
        $money3 = new Money(200, new Currency('EUR'));

        $this->assertEquals(0, $money1->compareTo($money2));
        $this->assertNotEquals(0, $money1->compareTo($money3));
        $this->assertEquals(-1, $money1->compareTo($money3));
        $this->assertEquals(1, $money3->compareTo($money1));

        $this->assertTrue($money1->equalTo($money2));
        $this->assertFalse($money1->equalTo($money3));
        $this->assertFalse($money1->greaterThan($money3));
        $this->assertFalse($money1->greaterThan($money2));
        $this->assertTrue($money3->greaterThan($money1));
        $this->assertTrue($money1->lessThan($money3));
        $this->assertFalse($money1->lessThan($money2));
        $this->assertFalse($money3->lessThan($money1));
        $this->assertTrue($money1->greaterThanOrEqual($money2));
        $this->assertTrue($money3->greaterThanOrEqual($money1));
        $this->assertFalse($money1->greaterThanOrEqual($money3));
        $this->assertTrue($money1->lessThanOrEqual($money2));
        $this->assertTrue($money1->lessThanOrEqual($money3));
        $this->assertFalse($money3->lessThanOrEqual($money1));
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\CurrencyMismatchException
     */
    public function testCannotCompareMoneyWithDifferentCurrency()
    {
        $money1 = new Money(100, new Currency('EUR'));
        $money2 = new Money(200, new Currency('GBP'));

        $money1->compareTo($money2);
    }

    public function testMoneyCanBeMultiplied()
    {
        $money1 = new Money(100, new Currency('EUR'));
        $money2 = new Money(5, new Currency('EUR'));

        $this->assertEquals(200, $money1->multiply(2)->getAmount());
        $this->assertEquals(750, $money1->multiply(7.5)->getAmount());
        $this->assertEquals(1000, $money1->multiply(10)->getAmount());
        $this->assertEquals(3, $money2->multiply(0.5)->getAmount());
        $this->assertEquals(2, $money2->multiply(0.5, PHP_ROUND_HALF_DOWN)->getAmount());
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidRoundingModeException
     */
    public function testCannotMultiplyMoneyUsingInvalidRoundingMode()
    {
        $money = new Money(5, new Currency('EUR'));

        $money->multiply(0.5, 'up');
    }

    public function testMoneyCanBeDivided()
    {
        $money = new Money(100, new Currency('EUR'));

        $this->assertEquals(20, $money->divide(5)->getAmount());
        $this->assertEquals(80, $money->divide(1.25)->getAmount());
        $this->assertEquals(303, $money->divide(0.33)->getAmount());
        $this->assertEquals(0, $money->divide(200, PHP_ROUND_HALF_DOWN)->getAmount());
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidRoundingModeException
     */
    public function testCannotDivideMoneyUsingInvalidRoundingMode()
    {
        $money = new Money(100, new Currency('EUR'));

        $money->divide(5, 'up');
    }

    public function testPercentageOfMoney()
    {
        $money1 = new Money(100, new Currency('EUR'));
        $money2 = new Money(50, new Currency('EUR'));

        $this->assertEquals(21, $money1->percentage(21)->getAmount());
        $this->assertEquals(3, $money2->percentage(5)->getAmount());
        $this->assertEquals(2, $money2->percentage(5, PHP_ROUND_HALF_DOWN)->getAmount());
    }

    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidRoundingModeException
     */
    public function testCannotTakePercentageOfMoneyWithInvalidRoundingMode()
    {
        $money = new Money(25, new Currency('EUR'));

        $money->percentage(5, 'up');
    }
}
