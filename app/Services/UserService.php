<?php
declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\UserLoginDTO;
use App\DataTransferObjects\UserRegisterDTO;
use App\Domain\Entities\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    public UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserRegisterDTO $registerDTO
     * @return array
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function register(UserRegisterDTO $registerDTO): array
    {
        $user = new User(
            (string)Str::uuid(),
            $registerDTO->getName(),
            $registerDTO->getEmail(),
        );

        $this->userRepository->create($user, $registerDTO->getPassword());

        $token = $this->userRepository->createToken($user->getId());

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'token' => $token,
        ];
    }

    /**
     * @param \App\DataTransferObjects\UserLoginDTO
     * @return array
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function login(UserLoginDTO $userLoginDTO): array
    {
        $user = $this->userRepository->findByEmailAndPassword($userLoginDTO->getEmail(), $userLoginDTO->getPassword());

        $token = $this->userRepository->createToken($user->getId());

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'token' => $token,
        ];
    }

    /**
     * @param string $userId
     * @return void
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function logout(string $userId): void
    {
        $this->userRepository->deleteToken($userId);
    }
}
