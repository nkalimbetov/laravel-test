<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPointsRule extends Model
{
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

    /**
     * @var string
     */
    protected $table = 'loyalty_points_rule';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'points_rule',
        'accrual_type',
        'accrual_value',
    ];
}
