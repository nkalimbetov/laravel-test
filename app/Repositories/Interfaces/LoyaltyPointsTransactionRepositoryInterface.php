<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Domain\Aggregates\LoyaltyPointsTransaction;

interface LoyaltyPointsTransactionRepositoryInterface
{
    /**
     * @param string $accountId
     * @return float
     */
    public function getBalance(string $accountId): float;

    /**
     * @param \App\Domain\Aggregates\LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return void
     */
    public function create(LoyaltyPointsTransaction $loyaltyPointsTransaction): void;

    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return void
     */
    public function update(LoyaltyPointsTransaction $loyaltyPointsTransaction): void;
}
