<?php
declare(strict_types=1);

namespace App\Services;

use App\Domain\Entities\LoyaltyPointsRule;
use App\Repositories\Interfaces\LoyaltyPointsRuleInterface;

class LoyaltyPointsRuleService
{
    /**
     * @var LoyaltyPointsRuleInterface
     */
    protected LoyaltyPointsRuleInterface $loyaltyPointsRule;

    /**
     * @param LoyaltyPointsRuleInterface $loyaltyPointsRule
     */
    public function __construct(LoyaltyPointsRuleInterface $loyaltyPointsRule)
    {
        $this->loyaltyPointsRule = $loyaltyPointsRule;
    }

    /**
     * @param string $loyaltyRule
     * @return LoyaltyPointsRule
     * @throws \App\Exceptions\LoyaltyRuleNotFoundException
     */
    public function getByRule(string $loyaltyRule): LoyaltyPointsRule
    {
        return $this->loyaltyPointsRule->getByRule($loyaltyRule);
    }
}
