# Money class

## About

This money library handles amounts with currencies. The values for the money objects are int, we don't use floats.

## Installation

Install the library through composer. Use the following command:

```bash
$ composer require jonasdekeukelaere/money
```

## Basic example

```php
use JonasDeKeukelaere\Money\Money;
use JonasDeKeukelaere\Money\Currency;

$money = new Money(100, new Currency('EUR')); // 1.00 euro
$money->getAmount(); // 100
$money->getCurrency(); // EUR
```
