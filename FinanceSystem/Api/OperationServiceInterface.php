<?php
declare(strict_types=1);

namespace FinanceSystem\Api;

use FinanceSystem\Entity\Operation\OperationInterface;

interface OperationServiceInterface
{
    public function performOperation(OperationInterface $operation): void;
}
