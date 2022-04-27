<?php

namespace App\Listeners;

use App\Events\AccountStatusChanged;
use App\Mail\AccountActivated;
use App\Mail\AccountDeactivated;
use App\Services\LoyaltyAccountService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendAccountStatusChangeNotification implements ShouldQueue
{
    /**
     * @var LoyaltyAccountService
     */
    public LoyaltyAccountService $loyaltyAccountService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LoyaltyAccountService $loyaltyAccountService)
    {
        $this->loyaltyAccountService = $loyaltyAccountService;
    }

    /**
     * Handle the event.
     *
     * @param  AccountStatusChanged  $event
     * @return void
     */
    public function handle(AccountStatusChanged $event)
    {
        $loyaltyAccount = $this->loyaltyAccountService->getById($event->accountId);

        if ($loyaltyAccount->getEmail() != '' && $loyaltyAccount->isEmailVerification()) {
            if ($loyaltyAccount->isActive()) {
                Mail::to($this)->send(new AccountActivated($this->loyaltyAccountService->getBalance($loyaltyAccount)));
            } else {
                Mail::to($this)->send(new AccountDeactivated());
            }
        }

        if ($loyaltyAccount->getPhone() != '' && $loyaltyAccount->isPhoneVerification()) {
            // instead SMS component
            Log::info('Account: phone: ' . $loyaltyAccount->getPhone() . ' ' . ($loyaltyAccount->isActive() ? 'Activated' : 'Deactivated'));
        }
    }
}
