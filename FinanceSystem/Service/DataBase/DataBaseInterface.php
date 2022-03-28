<?php
declare(strict_types=1);

namespace FinanceSystem\Service\DataBase;

use FinanceSystem\Entity\Account\AccountInterface;
use FinanceSystem\Entity\Operation\OperationInterface;

interface DataBaseInterface
{
    /**
     * @return AccountInterface[]
     */
    public function retrieveAccounts(): array;

    public function getAccountByNumber(string $accountNumber): ?AccountInterface;

    /**git
     * @param string $accountNumber
     *
     * @return OperationInterface[]
     */
    public function getOperationsByAccountNumber(string $accountNumber): array;

    /**
     * abstract method that flushes all changes in db entities
     * @return void
     */
    public function flush(): void;
}
