<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\LoyaltyPointsRuleInterface;
use App\Exceptions\LoyaltyRuleNotFoundException;
use App\Models\LoyaltyPointsRule as LoyaltyPointsRuleModel;

class LoyaltyPointsRuleRepository implements LoyaltyPointsRuleInterface
{
    /**
     * @param int $loyaltyRule
     * @return \App\Domain\Entities\LoyaltyPointsRule
     * @throws \App\Exceptions\LoyaltyRuleNotFoundException
     */
    public function getByRule(int $loyaltyRule): \App\Domain\Entities\LoyaltyPointsRule
    {
        $loyaltyRule = LoyaltyPointsRuleModel::where('points_rule', $loyaltyRule)->first();
        if (! $loyaltyRule) {
            throw new LoyaltyRuleNotFoundException('Loyalty point rule not found');
        }

        return new \App\Domain\Entities\LoyaltyPointsRule(
            $loyaltyRule->post('id'),
            $loyaltyRule->post('points_rule'),
            $loyaltyRule->post('accrual_type'),
            $loyaltyRule->post('accrual_value'),
        );
    }
}
