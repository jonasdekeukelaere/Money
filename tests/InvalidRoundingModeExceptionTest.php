<?php

namespace JonasDeKeukelaere\Money\tests;

use JonasDeKeukelaere\Money\InvalidRoundingModeException;

/**
 * Class InvalidRoundingModeExceptionTest.php
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class InvalidRoundingModeExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \JonasDeKeukelaere\Money\InvalidRoundingModeException
     * @expectedExceptionMessage Rounding mode 5 does not exist.
     */
    public function testCreatingExceptionWithoutPossibleRoundingModes()
    {
        throw InvalidRoundingModeException::doesNotExist(5, array());
    }
}
