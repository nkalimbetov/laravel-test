<?php

namespace App\Http\Controllers;

use App\Exceptions\AccountNotFoundException;
use App\Http\Requests\AccountCreateRequest;
use App\Services\LoyaltyAccountService;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    /**
     * @var LoyaltyAccountService
     */
    protected LoyaltyAccountService $loyaltyAccountService;

    /**
     * @param LoyaltyAccountService $loyaltyAccountService
     */
    public function __construct(LoyaltyAccountService $loyaltyAccountService)
    {
        $this->loyaltyAccountService = $loyaltyAccountService;
    }

    /**
     * @param \App\Http\Requests\AccountCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\AccountCannotCreateException
     */
    public function create(AccountCreateRequest $request): JsonResponse
    {
        $data = $this->loyaltyAccountService->create($request->getDTO());

        return response()->json($data, 201);
    }

    /**
     * @param string $type
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(string $type, string $id): JsonResponse
    {
        try {
            $this->loyaltyAccountService->activate($type, $id);
        } catch (AccountNotFoundException $exception) {
            return response()->json(['message' => 'Account is not found'], 400);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['message' => 'Wrong parameters'], 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param string $type
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(string $type, string $id): JsonResponse
    {
        try {
            $this->loyaltyAccountService->deactivate($type, $id);
        } catch (AccountNotFoundException $exception) {
            return response()->json(['message' => 'Account is not found'], 400);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['message' => 'Wrong parameters'], 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param string $type
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function balance(string $type, string $id): JsonResponse
    {
        try {
            $loyaltyAccount = $this->loyaltyAccountService->getByType($type, $id);
        } catch (AccountNotFoundException $exception) {
            return response()->json(['message' => 'Account is not found'], 400);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['message' => 'Wrong parameters'], 400);
        }

        return response()->json(['balance' => $this->loyaltyAccountService->getBalance($loyaltyAccount)]);
    }
}
