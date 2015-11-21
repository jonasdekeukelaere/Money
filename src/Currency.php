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
}
