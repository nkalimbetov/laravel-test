<?php
declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public string $accountId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $accountId)
    {
        $this->accountId = $accountId;
    }
}
