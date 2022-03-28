<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Operation;

use FinanceSystem\Entity\Operation\OperationInterface;

interface OperationPerformerInterface
{
    public function perform(OperationInterface $operation): void;
}
