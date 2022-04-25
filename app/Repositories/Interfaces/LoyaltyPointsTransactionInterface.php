<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface LoyaltyPointsTransactionInterface
{
    /**
     * @param string $accountId
     * @return float
     */
    public function getBalance(string $accountId): float;
}
