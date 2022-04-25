<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Entities\User;
use App\Exceptions\UserNotFoundException;
use App\Models\User as UserModel;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param \App\Domain\Entities\User $user
     * @param string $password
     * @return void
     */
    public function create(User $user, string $password): void
    {
        UserModel::create([
            'uid' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make($password),
        ]);
    }

    /**
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function findByEmailAndPassword(string $email, string $password): User
    {
        $model = UserModel::where('email', $email)
            ->where(Hash::make($password))
            ->first();

        if (!$model) {
            throw new UserNotFoundException("User with email {$email} and password not found");
        }

        return new User(
            $model->id,
            $model->name,
            $model->email,
        );
    }

    /**
     * @param string $userId
     * @return string
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function createToken(string $userId): string
    {
        $model = UserModel::find($userId);

        if (!$model) {
            throw new UserNotFoundException("User with id {$userId} not found");
        }

        return $model->createToken('apiToken')->plainTextToken;
    }

    /**
     * @param string $userId
     * @return void
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function deleteToken(string $userId): void
    {
        $model = UserModel::find($userId);

        if (!$model) {
            throw new UserNotFoundException("User with id {$userId} not found");
        }

        $model->tokens()->delete();
    }
}
