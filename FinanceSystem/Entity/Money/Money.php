<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Money;

use FinanceSystem\Exception\MoneyException;

class Money implements MoneyInterface {
    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $currency;

    public function __construct(
        float $value,
        string $currency
    ) {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param MoneyInterface $money
     *
     * @return void
     *
     * @throws MoneyException
     */
    public function add(MoneyInterface $money):void {
        if ($this->currency !== $money->getCurrency()) {
            throw new MoneyException('Currencies don\'t match');
        }

        $this->value += $money->value;
    }

    /**
     * @param MoneyInterface $money
     *
     * @return void
     *
     * @throws MoneyException
     */
    public function subtract(MoneyInterface $money):void {
        if ($this->currency !== $money->getCurrency()) {
            throw new MoneyException('Currencies don\'t match');
        }

        if ($this->value < $money->value) {
            throw new MoneyException('VInsufficient value');
        }

        $this->value -= $money->value;
    }
}
