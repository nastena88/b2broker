<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Operation;

use FinanceSystem\Entity\Operation\OperationInterface;

class OperationPerformerFactory
{
    /**
     * @var OperationPerformerInterface
     *
     * array with keys [
     *  'withdraw' => WithdrawOperationPerformer::class,
     *  ...
     * ]
     */
    private $performers;

    public function __construct(
        array $performers
    ) {
        $this->performers = $performers;
    }

    public function getPerformer(OperationInterface $operation): OperationPerformerInterface
    {
        return $this->performers[$operation->getName()];
    }

    public function addPerformer(string $name, OperationPerformerInterface $performer)
    {
        $this->performers[$name] = $performer;
    }
}
