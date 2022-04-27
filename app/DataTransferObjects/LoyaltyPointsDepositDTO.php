<?php
declare(strict_types=1);

namespace App\DataTransferObjects;

class LoyaltyPointsDepositDTO
{
    /**
     * @var string
     */
    private string $accountId;

    /**
     * @var string
     */
    private string $accountType;

    /**
     * @var string
     */
    private string $pointsRule;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var string
     */
    private string $paymentId;

    /**
     * @var float
     */
    private float $paymentAmount;

    /**
     * @var \DateTime
     */
    private \DateTime $paymentTime;

    /**
     * @param string $accountId
     * @param string $accountType
     * @param string $pointsRule
     * @param string $description
     * @param string $paymentId
     * @param float $paymentAmount
     * @param \DateTime $paymentTime
     */
    public function __construct(string $accountId, string $accountType, string $pointsRule, string $description, string $paymentId, float $paymentAmount, \DateTime $paymentTime)
    {
        $this->accountId = $accountId;
        $this->accountType = $accountType;
        $this->pointsRule = $pointsRule;
        $this->description = $description;
        $this->paymentId = $paymentId;
        $this->paymentAmount = $paymentAmount;
        $this->paymentTime = $paymentTime;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        return $this->accountType;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @return float
     */
    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentTime(): \DateTime
    {
        return $this->paymentTime;
    }
}
