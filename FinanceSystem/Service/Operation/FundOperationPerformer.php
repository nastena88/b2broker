<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Operation;

use FinanceSystem\Entity\Operation\FundOperation;
use FinanceSystem\Entity\Operation\OperationInterface;
use FinanceSystem\Exception\InvalidOperationException;
use FinanceSystem\Exception\LockException;
use FinanceSystem\Service\DataBase\DataBaseInterface;
use FinanceSystem\Service\Lock\LockServiceInterface;

class FundOperationPerformer implements OperationPerformerInterface
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

    /**
     * @param OperationInterface $operation
     *
     * @return void
     *
     * @throws InvalidOperationException
     * @throws LockException
     */
    public function perform(OperationInterface $operation): void
    {
        if (!$operation instanceof FundOperation) {
            throw new InvalidOperationException('Invalid operation');
        }

        $account = $this->database->getAccountByNumber($operation->g());

        //we need to use lock to prevent money operations by different processes
        if (!$this->lock->acquireLock($operation->getAccountNumber())) {
            throw new LockException('Cannot acquire lock');
        }

        try {
            $account->getBalance()->add($operation->getAmount());
            $account->addOperation($operation);
            $this->database->flush();
        } finally {
            $this->lock->releaseLock($operation->getAccountNumber());
        }
    }
}
