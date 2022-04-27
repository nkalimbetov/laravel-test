<?php
declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface LoyaltyPointsRuleInterface
{
    /**
     * @param int $loyaltyRule
     * @return \App\Domain\Entities\LoyaltyPointsRule
     * @throws \App\Exceptions\LoyaltyRuleNotFoundException
     */
    public function getByRule(int $loyaltyRule): \App\Domain\Entities\LoyaltyPointsRule;
}
