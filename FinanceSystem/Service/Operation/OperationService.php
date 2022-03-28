<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Operation;

use FinanceSystem\Api\OperationServiceInterface;
use FinanceSystem\Entity\Operation\OperationInterface;

class OperationService implements OperationServiceInterface
{
    /**
     * @var OperationPerformerFactory
     */
    private $performerFactory;

    public function __construct(
        OperationPerformerFactory $performerFactory
    ) {
        $this->performerFactory = $performerFactory;
    }

    public function performOperation(OperationInterface $operation): void
    {
        $performer = $this->performerFactory->getPerformer($operation);

        $performer->perform($operation);
    }
}
