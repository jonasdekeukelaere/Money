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
     * @var int[]
     */
    private static $roundingModes = array(
        PHP_ROUND_HALF_UP,
        PHP_ROUND_HALF_DOWN,
        PHP_ROUND_HALF_EVEN,
        PHP_ROUND_HALF_ODD,
    );

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

    /**
     * @param Money $otherMoney
     *
     * @return Money
     *
     * @throws CurrencyMismatchException
     */
    public function add(Money $otherMoney)
    {
        $this->compareCurrency($otherMoney);

        $amount = $this->amount + $otherMoney->getAmount();

        return new Money($amount, $this->currency);
    }

    /**
     * @param Money $otherMoney
     *
     * @return Money
     *
     * @throws CurrencyMismatchException
     */
    public function subtract(Money $otherMoney)
    {
        $this->compareCurrency($otherMoney);

        $amount = $this->amount - $otherMoney->getAmount();

        return new Money($amount, $this->currency);
    }

    /**
     * @param Money $otherMoney
     *
     * @return int
     *
     * @throws CurrencyMismatchException
     */
    public function compareTo(Money $otherMoney)
    {
        $this->compareCurrency($otherMoney);

        if ($this->amount === $otherMoney->getAmount()) {
            return 0;
        }

        return ($this->amount < $otherMoney->getAmount()) ? -1 : 1;
    }

    /**
     * @param float $factor
     * @param int   $roundingMode
     *
     * @return Money
     *
     * @throws InvalidRoundingModeException
     */
    public function multiply($factor, $roundingMode = PHP_ROUND_HALF_UP)
    {
        if (!in_array($roundingMode, self::$roundingModes)) {
            throw InvalidRoundingModeException::doesNotExist($roundingMode, self::$roundingModes);
        }

        $amount = round($this->amount * $factor, 0, $roundingMode);

        return new Money((int) $amount, $this->currency);
    }

    /**
     * @param float $divisor
     * @param int   $roundingMode
     *
     * @return Money
     *
     * @throws InvalidRoundingModeException
     */
    public function divide($divisor, $roundingMode = PHP_ROUND_HALF_UP)
    {
        if (!in_array($roundingMode, self::$roundingModes)) {
            throw InvalidRoundingModeException::doesNotExist($roundingMode, self::$roundingModes);
        }

        $amount = round($this->amount / $divisor, 0, $roundingMode);

        return new Money((int) $amount, $this->currency);
    }

    /**
     * @param float $percentage
     * @param int   $roundingMode
     *
     * @return Money
     *
     * @throws InvalidRoundingModeException
     */
    public function percentage($percentage, $roundingMode = PHP_ROUND_HALF_UP)
    {
        if (!in_array($roundingMode, self::$roundingModes)) {
            throw InvalidRoundingModeException::doesNotExist($roundingMode, self::$roundingModes);
        }

        return $this->multiply($percentage / 100, $roundingMode);
    }

    /**
     * @param Money $otherMoney
     *
     * @return bool
     *
     * @throws CurrencyMismatchException
     */
    public function equalTo(Money $otherMoney)
    {
        return ($this->compareTo($otherMoney) === 0);
    }

    /**
     * @param Money $otherMoney
     *
     * @return bool
     *
     * @throws CurrencyMismatchException
     */
    public function greaterThan(Money $otherMoney)
    {
        return ($this->compareTo($otherMoney) === 1);
    }

    /**
     * @param Money $otherMoney
     *
     * @return bool
     *
     * @throws CurrencyMismatchException
     */
    public function lessThan(Money $otherMoney)
    {
        return ($this->compareTo($otherMoney) === -1);
    }

    /**
     * @param Money $otherMoney
     *
     * @return bool
     *
     * @throws CurrencyMismatchException
     */
    public function greaterThanOrEqual(Money $otherMoney)
    {
        return ($this->compareTo($otherMoney) >= 0);
    }

    /**
     * @param Money $otherMoney
     *
     * @return bool
     *
     * @throws CurrencyMismatchException
     */
    public function lessThanOrEqual(Money $otherMoney)
    {
        return ($this->compareTo($otherMoney) <= 0);
    }

    /**
     * @param Money $otherMoney
     *
     * @throws CurrencyMismatchException
     */
    private function compareCurrency(Money $otherMoney)
    {
        if ($this->currency->compareTo($otherMoney->getCurrency()) !== 0) {
            throw CurrencyMismatchException::currenciesNotMatching(
                $this->currency->getCode(),
                $otherMoney->getCurrency()->getCode()
            );
        }
    }
}
