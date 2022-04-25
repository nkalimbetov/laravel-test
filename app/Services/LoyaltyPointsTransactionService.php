<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Interfaces\LoyaltyPointsTransactionInterface;

class LoyaltyPointsTransactionService
{
    /**
     * @var LoyaltyPointsTransactionInterface
     */
    protected LoyaltyPointsTransactionInterface $loyaltyPointsTransaction;

    /**
     * @param LoyaltyPointsTransactionInterface $loyaltyPointsTransaction
     */
    public function __construct(LoyaltyPointsTransactionInterface $loyaltyPointsTransaction)
    {
        $this->loyaltyPointsTransaction = $loyaltyPointsTransaction;
    }

    /**
     * @param string $accountId
     * @return float
     */
    public function getBalance(string $accountId): float
    {
        return $this->loyaltyPointsTransaction->getBalance($accountId);
    }
}
