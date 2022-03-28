<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Account;

use FinanceSystem\Api\AccountServiceInterface;
use FinanceSystem\Api\SortKey;
use FinanceSystem\Entity\Money\MoneyInterface;
use FinanceSystem\Entity\Operation\OperationInterface;
use FinanceSystem\Exception\InvalidSortKeyException;
use FinanceSystem\Exception\NotFoundException;
use FinanceSystem\Service\DataBase\DataBaseInterface;

class AccountService implements AccountServiceInterface
{
    /**
     * @var DataBaseInterface
     */
    private $database;

    public function __construct(
        DataBaseInterface $database
    ) {
        $this->database = $database;
    }

    public function getAccounts(): array
    {
        return $this->database->retrieveAccounts();
    }

    /**
     * @param string $accountNumber
     *
     * @return MoneyInterface
     *
     * @throws NotFoundException
     */
    public function getAccountBalance(string $accountNumber): MoneyInterface
    {
        $account = $this->database->getAccountByNumber($accountNumber);

        if ($account === null) {
            throw new NotFoundException('Account not found');
        }

        return $account->getBalance();
    }

    /**
     * @param string $accountNumber
     * @param string $sortKey
     *
     * @return array|OperationInterface[]
     *
     * @throws InvalidSortKeyException
     */
    public function getAccountOperations(string $accountNumber, string $sortKey): array
    {
        $operations = $this->database->getOperationsByAccountNumber($accountNumber);

        if (!in_array($sortKey, SortKey::AVAILABLE_KEYS)) {
            throw new InvalidSortKeyException('Invalid key');
        }

        usort(
            $operations,
            static function (OperationInterface $operationA, OperationInterface $operationB) use ($sortKey) {
                return $operationA->$$sortKey() <=> $operationB->$$sortKey();
            }
        );

        return $operations;
    }

}