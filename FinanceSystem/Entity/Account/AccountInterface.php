<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Account;

use FinanceSystem\Entity\Money\MoneyInterface;
use FinanceSystem\Entity\Operation\OperationInterface;

interface AccountInterface {
    public function getOwnerId(): int;

    public function getAccountNumber(): string;

    public function getBalance(): MoneyInterface;

    public function addOperation(OperationInterface $operation): AccountInterface;

    /**
     * @return OperationInterface[]
     */
    public function getOperations(): array;
}