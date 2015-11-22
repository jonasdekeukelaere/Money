# Money class

## About

This money library handles amounts with currencies. The values for the money objects are int, we don't use floats.

## Installation

Install the library through composer. Use the following command:

```bash
$ composer require jonasdekeukelaere/money
```

## Basic examples

```php
use JonasDeKeukelaere\Money\Money;
use JonasDeKeukelaere\Money\Currency;

$money = new Money(100, new Currency('EUR')); // 1.00 euro
$money->getAmount(); // 100
$money->getCurrency(); // EUR

$addedMoney = $money->add($money); // 2.00 euro
$subtractedMoney = $money->subtract($money); // 0.00 euro
$multipliedMoney = $money->multiply(5); // 5.00 euro
$dividedMoney = $money->divide(2); // 0.50 euro
$percentageOfMoney = $money->percentage(50); // 0.50 euro

$equalMoney = new Money(100, new Currency('EUR'));
$differentMoney = new Money(200, new Currency('EUR'));

$money->compareTo($equalMoney); // 0
$money->compareTo($differentMoney); // -1
$differentMoney->compareTo($money); // 1
$money->equalTo($equalMoney); // true
$money->equalTo($differentMoney); // false
$money->greaterThan($equalMoney); // false
$money->greaterThan($differentMoney); // false
$differentMoney->greaterThan($money); // true
$money->lessThan($equalMoney); // false
$money->lessThan($differentMoney); // true
$differentMoney->lessThan($money); // false
```
