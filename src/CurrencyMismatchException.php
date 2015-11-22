<?php

namespace JonasDeKeukelaere\Money;

class CurrencyMismatchException extends \InvalidArgumentException
{
    public static function currenciesNotMatching($currency1, $currency2)
    {
        return new static(sprintf('Currencies are not matching: %s and %s.', $currency1, $currency2));
    }
}
