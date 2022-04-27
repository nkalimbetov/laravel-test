<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    public UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param \App\Http\Requests\UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws UserNotFoundException
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $this->userService->register($request->getDTO());

        return response()->json($data, 201);
    }

    /**
     * @param \App\Http\Requests\UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        try {
            $data = $this->userService->login($request->getDTO());
            return response()->json($data, 201);
        } catch (UserNotFoundException $exception) {
            return response()->json(['message' => 'Bad credentials'], 401);
        }
    }

    /**
     * @throws UserNotFoundException
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $this->userService->logout($request->post('user_id'));

        return response()->json(['message' => 'Logged out'], 201);
    }
}
