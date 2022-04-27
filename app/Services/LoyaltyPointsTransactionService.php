<?php
declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\LoyaltyPointsDepositDTO;
use App\Domain\Aggregates\LoyaltyPointsTransaction;
use App\Repositories\Interfaces\LoyaltyPointsTransactionRepositoryInterface;
use Illuminate\Support\Str;

class LoyaltyPointsTransactionService
{
    /**
     * @var LoyaltyPointsTransactionRepositoryInterface
     */
    protected LoyaltyPointsTransactionRepositoryInterface $loyaltyPointsTransaction;

    /**
     * @var LoyaltyAccountService
     */
    protected LoyaltyAccountService $loyaltyAccountService;

    /**
     * @var LoyaltyPointsRuleService
     */
    protected LoyaltyPointsRuleService $loyaltyPointsRuleService;

    /**
     * @param LoyaltyPointsTransactionRepositoryInterface $loyaltyPointsTransaction
     */
    public function __construct(LoyaltyPointsTransactionRepositoryInterface $loyaltyPointsTransaction,
                                LoyaltyAccountService                       $loyaltyAccountService,
                                LoyaltyPointsRuleService                    $loyaltyPointsRuleService)
    {
        $this->loyaltyPointsTransaction = $loyaltyPointsTransaction;
        $this->loyaltyAccountService = $loyaltyAccountService;
        $this->loyaltyPointsRuleService = $loyaltyPointsRuleService;
    }

    /**
     * @param string $accountId
     * @return float
     */
    public function getBalance(string $accountId): float
    {
        return $this->loyaltyPointsTransaction->getBalance($accountId);
    }

    /**
     * @param LoyaltyPointsDepositDTO $loyaltyPointsDepositDTO
     * @return array
     * @throws \App\Exceptions\AccountNotFoundException
     * @throws \App\Exceptions\LoyaltyRuleNotFoundException
     */
    public function performPaymentLoyaltyPoints(LoyaltyPointsDepositDTO $loyaltyPointsDepositDTO): LoyaltyPointsTransaction
    {
        $loyaltyAccount = $this->loyaltyAccountService->getByType($loyaltyPointsDepositDTO->getAccountType(), $loyaltyPointsDepositDTO->getAccountId());
        $loyaltyPointsRule = $this->loyaltyPointsRuleService->getByRule($loyaltyPointsDepositDTO->getPointsRule());
        $loyaltyPointsTransaction = new LoyaltyPointsTransaction(
            (string)Str::uuid(),
            $loyaltyAccount,
            $loyaltyPointsRule->calculatePointAmount($loyaltyPointsDepositDTO->getPaymentAmount()),
            $loyaltyPointsDepositDTO->getDescription(),
            $loyaltyPointsDepositDTO->getPaymentTime(),
            $loyaltyPointsDepositDTO->getPaymentAmount(),
            $loyaltyPointsDepositDTO->getPaymentId(),
            $loyaltyPointsRule,
        );

        $this->loyaltyPointsTransaction->create($loyaltyPointsTransaction);

        return $loyaltyPointsTransaction;
    }


    public function withdrawLoyaltyPoints(LoyaltyPointsWithdrawDTO $loyaltyPointsWithdrawDTO): LoyaltyPointsTransaction
    {
        // TODO: Implement create() method.
    }

    public function cancel(LoyaltyPointsCancelDTO $loyaltyPointsCancelDTO): LoyaltyPointsTransaction
    {
        // TODO: Implement create() method.
    }
}
