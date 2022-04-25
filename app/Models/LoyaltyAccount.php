<?php
declare(strict_types=1);

namespace App\Models;

use App\Mail\AccountActivated;
use App\Mail\AccountDeactivated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoyaltyAccount extends Model
{
    protected $table = 'loyalty_account';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'phone',
        'card',
        'email',
        'email_notification',
        'phone_notification',
        'active',
    ];
}
