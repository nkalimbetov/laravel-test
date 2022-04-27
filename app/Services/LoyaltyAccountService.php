<?php
declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\AccountCreateDTO;
use App\Domain\Aggregates\LoyaltyAccount;
use App\Events\AccountStatusChanged;
use App\Repositories\Interfaces\LoyaltyAccountRepositoryInterface;
use Illuminate\Support\Str;

class LoyaltyAccountService
{
    /**
     * @var LoyaltyAccountRepositoryInterface
     */
    protected LoyaltyAccountRepositoryInterface $loyaltyAccountRepository;

    /**
     * @var LoyaltyPointsTransactionService
     */
    protected LoyaltyPointsTransactionService $loyaltyPointsTransactionService;

    /**
     * @param LoyaltyAccountRepositoryInterface $loyaltyAccountRepository
     * @param LoyaltyPointsTransactionService $loyaltyPointsTransactionService
     */
    public function __construct(LoyaltyAccountRepositoryInterface $loyaltyAccountRepository,
                                LoyaltyPointsTransactionService $loyaltyPointsTransactionService)
    {
        $this->loyaltyAccountRepository = $loyaltyAccountRepository;
        $this->loyaltyPointsTransactionService = $loyaltyPointsTransactionService;
    }

    /**
     * @param AccountCreateDTO $accountCreateDTO
     * @return array
     * @throws \App\Exceptions\AccountCannotCreateException
     */
    public function create(AccountCreateDTO $accountCreateDTO): array
    {
        $loyaltyAccount = new LoyaltyAccount(
            (string)Str::uuid(),
            $accountCreateDTO->getPhone(),
            $accountCreateDTO->getCard(),
            $accountCreateDTO->getEmail(),
            $accountCreateDTO->isEmailVerification(),
            $accountCreateDTO->isPhoneVerification(),
            $accountCreateDTO->isActive()
        );

        $this->loyaltyAccountRepository->create($loyaltyAccount);

        return (array) $loyaltyAccount;
    }

    /**
     * @param string $accountId
     * @return LoyaltyAccount
     * @throws \App\Exceptions\AccountNotFoundException
     */
    public function getById(string $accountId): LoyaltyAccount
    {
        return $this->loyaltyAccountRepository->getById($accountId);
    }

    /**
     * @param string $type
     * @param string $id
     * @return LoyaltyAccount
     * @throws \App\Exceptions\AccountNotFoundException
     */
    public function getByType(string $type, string $id): LoyaltyAccount
    {
        return $this->loyaltyAccountRepository->getByType($type, $id);
    }

    /**
     * @param string $type
     * @param string $id
     * @return void
     * @throws \App\Exceptions\AccountNotFoundException
     */
    public function activate(string $type, string $id): void
    {
        $loyaltyAccount = $this->getByType($type, $id);
        $loyaltyAccount->activate();
        $this->loyaltyAccountRepository->changeStatus($loyaltyAccount);

        AccountStatusChanged::dispatch();
    }

    /**
     * @param string $type
     * @param string $id
     * @return void
     * @throws \App\Exceptions\AccountNotFoundException
     */
    public function deactivate(string $type, string $id): void
    {
        $loyaltyAccount = $this->getByType($type, $id);
        $loyaltyAccount->deactivate();
        $this->loyaltyAccountRepository->changeStatus($loyaltyAccount);

        AccountStatusChanged::dispatch();
    }

    /**
     * @param LoyaltyAccount $loyaltyAccount
     * @return float
     */
    public function getBalance(LoyaltyAccount $loyaltyAccount): float
    {
        return $this->loyaltyPointsTransactionService->getBalance($loyaltyAccount->getId());
    }
}
