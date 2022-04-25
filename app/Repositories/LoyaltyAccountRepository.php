<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Entities\LoyaltyAccount;
use App\Exceptions\AccountCannotCreateException;
use App\Exceptions\AccountNotFoundException;
use App\Repositories\Interfaces\LoyaltyAccountRepositoryInterface;
use App\Models\LoyaltyAccount as LoyaltyAccountModel;
use InvalidArgumentException;

class LoyaltyAccountRepository implements LoyaltyAccountRepositoryInterface
{
    /**
     * @param \App\Domain\Entities\LoyaltyAccount $account
     * @throws \App\Exceptions\AccountCannotCreateException
     */
    public function create(LoyaltyAccount $account): void
    {
        $model = LoyaltyAccountModel::create([
            'id' => $account->getId(),
            'phone' => $account->getPhone(),
            'card' => $account->getCard(),
            'email' => $account->getEmail(),
            'email_notification' => $account->isEmailVerification(),
            'phone_notification' => $account->isPhoneVerification(),
            'active' => $account->isActive(),
        ]);

        if (!$model) {
            throw new AccountCannotCreateException('Account cannot create');
        }
    }

    /**
     * @param \App\Domain\Entities\LoyaltyAccount $account
     * @return void
     */
    public function changeStatus(LoyaltyAccount $account): void
    {
        LoyaltyAccountModel::find($account->getId())->update('active', true);
    }

    /**
     * @param string $accountId
     * @return \App\Domain\Entities\LoyaltyAccount
     * @throws \App\Exceptions\AccountNotFoundException
     * @throws \InvalidArgumentException
     */
    public function getById(string $accountId): LoyaltyAccount
    {
        $model = LoyaltyAccountModel::find($accountId)->first();

        if (!$model) {
            throw new AccountNotFoundException('Account not found');
        }

        return $this->getLoyalAccountFromModel($model);
    }

    /**
     * @param string $type
     * @param string $id
     * @return \App\Domain\Entities\LoyaltyAccount
     * @throws \App\Exceptions\AccountNotFoundException
     * @throws \InvalidArgumentException
     */
    public function getByType(string $type, string $id): LoyaltyAccount
    {
        if (!in_array($type, ['email', 'phone', 'card'])) {
            throw new InvalidArgumentException('Invalid type');
        }

        $model = LoyaltyAccountModel::where($type, $id)->first();

        if (!$model) {
            throw new AccountNotFoundException('Account not found');
        }

        return $this->getLoyalAccountFromModel($model);
    }

    public function getBalance(): float
    {
        return LoyaltyPointsTransaction::where('canceled', '=', 0)->where('account_id', '=', $this->id)->sum('points_amount');
    }

    /**
     * @param LoyaltyAccountModel $model
     * @return LoyaltyAccount
     */
    private function getLoyalAccountFromModel(LoyaltyAccountModel $model): LoyaltyAccount
    {
        return new LoyaltyAccount(
            $model->id,
            $model->phone,
            $model->card,
            $model->email,
            $model->email_notification,
            $model->phone_notification,
            $model->active,
        );
    }
}
