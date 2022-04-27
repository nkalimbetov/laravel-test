<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoyaltyPointsDepositRequest;
use App\Services\LoyaltyPointsTransactionService;
use Illuminate\Http\JsonResponse;

class LoyaltyPointsController extends Controller
{
    protected LoyaltyPointsTransactionService $loyaltyPointsTransactionService

    /**
     * @param LoyaltyPointsTransactionService $loyaltyPointsTransactionService
     */
    public function __construct(LoyaltyPointsTransactionService $loyaltyPointsTransactionService)
    {
        $this->loyaltyPointsTransactionService = $loyaltyPointsTransactionService;
    }

    /**
     * @param LoyaltyPointsDepositRequest $request
     * @return JsonResponse
     */
    public function deposit(LoyaltyPointsDepositRequest $request): JsonResponse
    {
        $data = $this->loyaltyPointsTransactionService->performPaymentLoyaltyPoints($request->getDTO());

        return response()->json($data, 201);
    }

    public function cancel(LoyaltyPointsCancelRequest $request): JsonResponse
    {
        $data = $this->loyaltyPointsTransactionService->cancel($request->getDTO());

        return response()->json($data);
    }

    public function withdraw(LoyaltyPointsWithdrawRequest $request): JsonResponse
    {
        $data = $this->loyaltyPointsTransactionService->withdrawLoyaltyPoints($request->getDTO());

        return response()->json($data, 201);
    }
}
