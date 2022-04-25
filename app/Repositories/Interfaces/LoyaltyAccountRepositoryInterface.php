<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Domain\Entities\LoyaltyAccount;
use App\Exceptions\AccountCannotCreateException;

interface LoyaltyAccountRepositoryInterface
{
    /**
     * @param \App\Domain\Entities\LoyaltyAccount $user
     * @return void
     * @throws AccountCannotCreateException
     */
    public function create(LoyaltyAccount $user): void;

    /**
     * @param \App\Domain\Entities\LoyaltyAccount $user
     * @return void
     */
    public function changeStatus(LoyaltyAccount $user): void;

    /**
     * @param string $accountId
     * @return \App\Domain\Entities\LoyaltyAccount
     * @throws \App\Exceptions\AccountNotFoundException
     */
    public function getById(string $accountId): LoyaltyAccount;

    /**
     * @param string $type
     * @param string $id
     * @return \App\Domain\Entities\LoyaltyAccount
     * @throws \App\Exceptions\AccountNotFoundException
     */
    public function getByType(string $type, string $id): LoyaltyAccount;

    /**
     * @param LoyaltyAccount $loyaltyAccount
     * @return float
     */
    public function getBalance(LoyaltyAccount $loyaltyAccount): float;
}
