<?php

namespace JonasDeKeukelaere\Money;

class InvalidRoundingModeException extends \InvalidArgumentException
{
    public static function doesNotExist($roundingMode, array $roundingModes)
    {
        if (empty($roundingModes)) {
            throw new static(sprintf('Rounding mode %s does not exist.', $roundingMode));
        }

        return new static(
            sprintf(
                'Rounding mode %s does not exist: (Existing modes: %s).',
                $roundingMode,
                implode(', ', $roundingModes)
            )
        );
    }
}
