<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\LoyaltyPointsTransactionRepositoryInterface;
use App\Models\LoyaltyPointsTransaction as LoyaltyPointsTransactionModel;
use App\Domain\Aggregates\LoyaltyPointsTransaction;

class LoyaltyPointsTransactionRepository implements LoyaltyPointsTransactionRepositoryInterface
{
    /**
     * @param string $accountId
     * @return float
     */
    public function getBalance(string $accountId): float
    {
        return LoyaltyPointsTransactionModel::where('canceled', '=', 0)->where('account_id', '=', $accountId)->sum('points_amount');
    }

    /**
     * @param \App\Domain\Aggregates\LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return void
     */
    public function create(LoyaltyPointsTransaction $loyaltyPointsTransaction): void
    {
        // TODO: Implement create() method.
    }

    /**
     * @param LoyaltyPointsTransaction $loyaltyPointsTransaction
     * @return void
     */
    public function update(LoyaltyPointsTransaction $loyaltyPointsTransaction): void
    {
        // TODO: Implement update() method.
    }
}
