<?php

namespace JonasDeKeukelaere\Money;

/**
 * Money class
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Money
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var Currency
     */
    protected $currency;

    /**
     * @param int      $amount
     * @param Currency $currency
     *
     * @throws InvalidAmountException
     */
    public function __construct($amount, Currency $currency)
    {
        if (!is_int($amount)) {
            throw InvalidAmountException::notAnInteger($amount);
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
