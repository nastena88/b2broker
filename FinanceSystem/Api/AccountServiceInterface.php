<?php
declare(strict_types=1);

namespace FinanceSystem\Api;

use FinanceSystem\Entity\Money\MoneyInterface;
use FinanceSystem\Entity\Operation\OperationInterface;

interface AccountServiceInterface
{
    /**
     * @return AccountServiceInterface[]
     */
    public function getAccounts(): array;

    public function getAccountBalance(string $accountNumber): MoneyInterface;

    /**
     * @return OperationInterface[]
     */
    public function getAccountOperations(string $accountNumber, string $sortKey): array;
}
