<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Operation;

use FinanceSystem\Entity\Money\Money;

class FundOperation extends AbstractOperation implements OperationInterface
{
    protected const NAME = 'fund';

    /**
     * @var string
     */
    private $accountNumber;

    public function __construct(
        Money $amount,
        string $description,
        \DateTime $date,
        string $accountNumber
    ) {
        $this->accountNumber = $accountNumber;
        parent::__construct($amount, $description, $date);
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

}
