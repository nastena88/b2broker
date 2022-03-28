<?php

declare(strict_types=1);

namespace FinanceSystem\Entity\Account;

use FinanceSystem\Entity\Money\MoneyInterface;
use FinanceSystem\Entity\Operation\OperationInterface;

class Account implements AccountInterface {

    /**
     * @var int
     */
    private $ownerId;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var MoneyInterface
     */
    private $balance;

    /**
     * @var OperationInterface[]
     */
    private $operations;

    public function __construct(
        int $ownerId,
        string $accountNumber,
        MoneyInterface $balance
    ) {
        $this->ownerId = $ownerId;
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function getBalance(): MoneyInterface
    {
        return $this->balance;
    }

    public function addOperation(OperationInterface $operation): AccountInterface
    {
        $this->operations[] = $operation;

        return $this;
    }

    /**
     * @return OperationInterface[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }
}
