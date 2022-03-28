<?php
declare(strict_types=1);

namespace FinanceSystem\Api;

class SortKey
{
    public const BY_DESCRIPTION = 'getDescription';
    public const BY_DATE = 'getDate';

    public const AVAILABLE_KEYS = [
        self::BY_DESCRIPTION,
        self::BY_DATE,
    ];
}
