<?php
namespace JonasDeKeukelaere\Money;

class Currency
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @param string $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param Currency $otherCurrency
     *
     * @return int
     */
    public function compareTo(Currency $otherCurrency)
    {
        return strcmp($this->code, $otherCurrency->getCode());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCode();
    }
}
