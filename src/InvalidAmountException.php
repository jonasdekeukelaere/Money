<?php

namespace JonasDeKeukelaere\Money;

class InvalidAmountException extends \InvalidArgumentException
{
    public static function notAnInteger($amount)
    {
        return new static(sprintf('Amount %i is not an integer.', $amount));
    }
}
