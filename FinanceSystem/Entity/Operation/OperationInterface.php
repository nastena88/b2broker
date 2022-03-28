<?php
declare(strict_types=1);

namespace FinanceSystem\Entity\Operation;

use FinanceSystem\Entity\Money\Money;

interface OperationInterface
{
    public function getName(): string;

    public function getAmount(): Money;

    public function getDescription(): string;

    public function getDate(): \DateTime;
}

