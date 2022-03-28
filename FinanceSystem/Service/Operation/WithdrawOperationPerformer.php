<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Operation;

use FinanceSystem\Entity\Operation\OperationInterface;
use FinanceSystem\Entity\Operation\WithdrawOperation;
use FinanceSystem\Exception\InvalidOperationException;
use FinanceSystem\Exception\LockException;
use FinanceSystem\Service\DataBase\DataBaseInterface;
use FinanceSystem\Service\Lock\LockServiceInterface;

class WithdrawOperationPerformer implements OperationPerformerInterface
{
    /**
     * @var DataBaseInterface
     */
    private $database;

    /**
     * @var LockServiceInterface
     */
    private $lock;

    public function __construct(
        DataBaseInterface $database,
        LockServiceInterface $lock
    ) {
        $this->database = $database;
        $this->lock = $lock;
    }
    public function perform(OperationInterface $operation): void
    {
        if (!$operation instanceof WithdrawOperation) {
            throw new InvalidOperationException('Invalid operation');
        }

        $account = $this->database->getAccountByNumber($operation->getAccountNumber());

        if (!$this->lock->acquireLock($operation->getAccountNumber())) {
            throw new LockException('Cannot acquire lock');
        }

        try {
            $account->getBalance()->subtract($operation->getAmount());
            $account->addOperation($operation);
            $this->database->flush();
        } finally {
            $this->lock->releaseLock($operation->getAccountNumber());
        }
    }
}
