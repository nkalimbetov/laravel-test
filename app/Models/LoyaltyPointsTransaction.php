<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPointsTransaction extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     *//**
     * @var string[]
     */
    protected $keyType = 'string';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string
     */
    protected $table = 'loyalty_points_transaction';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'account_id',
        'points_rule',
        'points_amount',
        'description',
        'payment_id',
        'payment_amount',
        'payment_time',
    ];
}
