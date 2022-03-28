<?php
declare(strict_types=1);

namespace FinanceSystem\Service\Lock;

interface LockServiceInterface
{
    public function acquireLock(string $key): bool;

    public function releaseLock(string $key): void;
}