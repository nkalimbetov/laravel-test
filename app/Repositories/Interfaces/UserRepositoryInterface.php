<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Domain\Aggregates\User;

interface UserRepositoryInterface
{
    /**
     * @param \App\Domain\Aggregates\User $user
     * @param string $password
     * @return void
     */
    public function create(User $user, string $password): void;

    /**
     * @param string $email
     * @param string $password
     * @return \App\Domain\Aggregates\User
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function findByEmailAndPassword(string $email, string $password): User;

    /**
     * @param string $userId
     * @return string
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function createToken(string $userId): string;

    /**
     * @param string $userId
     * @return void
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function deleteToken(string $userId): void;
}
