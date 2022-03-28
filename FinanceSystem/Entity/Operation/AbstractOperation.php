<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Operation;

use FinanceSystem\Entity\Money\Money;

abstract class AbstractOperation implements OperationInterface
{
    protected const NAME = "operation";

    /**
     * @var Money
     */
    protected $amount;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $date;

    public function __construct(
        Money $amount,
        string $description,
        \DateTime $date
    ) {
        $this->amount = $amount;
        $this->description = $description;
        $this->date = $date;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return $this->getDescription();
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
