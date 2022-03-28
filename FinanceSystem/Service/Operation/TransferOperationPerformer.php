<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Operation;

use FinanceSystem\Entity\Operation\OperationInterface;
use FinanceSystem\Entity\Operation\TransferOperation;
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
        if (!$operation instanceof TransferOperation) {
            throw new InvalidOperationException('Invalid operation');
        }

        $accountFrom = $this->database->getAccountByNumber($operation->getAccountNumberFrom());
        $accountTo = $this->database->getAccountByNumber($operation->getAccountNumberTo());

        if (!$this->lock->acquireLock($operation->getAccountNumberFrom()) || !$this->lock->acquireLock($operation->getAccountNumberTo())) {
            throw new LockException('Cannot acquire lock');
        }

        try {
            $accountFrom->getBalance()->subtract($operation->getAmount());
            $accountTo->getBalance()->add($operation->getAmount());
            $accountFrom->addOperation($operation);
            $accountTo->addOperation($operation);
            $this->database->flush();
        } finally {
            $this->lock->releaseLock($operation->getAccountNumberFrom());
            $this->lock->releaseLock($operation->getAccountNumberTo());
        }
    }
}
