<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Money;

interface MoneyInterface {
    public function add(MoneyInterface $money): void;
    public function subtract(MoneyInterface $money): void;
}
