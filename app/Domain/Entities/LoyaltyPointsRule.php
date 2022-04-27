<?php
declare(strict_types=1);

namespace App\Domain\Entities;

class LoyaltyPointsRule
{
    private const ACCRUAL_TYPE_RELATIVE_RATE = 'relative_rate';

    private const ACCRUAL_TYPE_ABSOLUTE_POINTS_AMOUNT = 'absolute_points_amount';

    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $pointsRule;

    /**
     * @var string
     */
    private string $accrualType;

    /**
     * @var string
     */
    private string $accrualValue;

    /**
     * @param string $id
     * @param string $pointsRule
     * @param string $accrualType
     * @param string $accrualValue
     */
    public function __construct(string $id, string $pointsRule, string $accrualType, string $accrualValue)
    {
        $this->id = $id;
        $this->pointsRule = $pointsRule;
        $this->accrualType = $accrualType;
        $this->accrualValue = $accrualValue;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPointsRule(): string
    {
        return $this->pointsRule;
    }

    /**
     * @return string
     */
    public function getAccrualType(): string
    {
        return $this->accrualType;
    }

    /**
     * @return string
     */
    public function getAccrualValue(): string
    {
        return $this->accrualValue;
    }

    /**
     * @param float $paymentAmount
     * @return float
     */
    public function calculatePointAmount(float $paymentAmount): float
    {
        return match ($this->getAccrualType()) {
            self::ACCRUAL_TYPE_RELATIVE_RATE => ($paymentAmount / 100) * self::getAccrualValue(),
            self::ACCRUAL_TYPE_ABSOLUTE_POINTS_AMOUNT => self::getAccrualValue(),
            default => 0
        };
    }
}
