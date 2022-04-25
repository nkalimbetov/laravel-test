<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\LoyaltyPointsTransactionInterface;
use App\Models\LoyaltyPointsTransaction as LoyaltyPointsTransactionModel;

class LoyaltyPointsTransaction implements LoyaltyPointsTransactionInterface
{
    public function getBalance(string $accountId): float
    {
        return LoyaltyPointsTransactionModel::where('canceled', '=', 0)->where('account_id', '=', $accountId)->sum('points_amount');
    }
}
