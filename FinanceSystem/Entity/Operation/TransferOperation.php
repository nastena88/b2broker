<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Operation;

use FinanceSystem\Entity\Money\Money;

class TransferOperation extends AbstractOperation implements OperationInterface
{
    protected const NAME = 'transfer';

    /**
     * @var string
     */
    private $accountNumberFrom;

    /**
     * @var string
     */
    private $accountNumberTo;

    public function __construct(
        Money $amount,
        string $description,
        \DateTime $date,
        string $accountNumberFrom,
        string $accountNumberTo
    ) {
        $this->accountNumberFrom = $accountNumberFrom;
        $this->accountNumberTo = $accountNumberTo;
        parent::__construct($amount, $description, $date);
    }

    public function getAccountNumberFrom(): string
    {
        return $this->accountNumberFrom;
    }

    public function getAccountNumberTo(): string
    {
        return $this->accountNumberTo;
    }
}
