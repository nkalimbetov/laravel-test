<?php
declare(strict_types=1);

namespace App\Domain\Aggregates;

use App\Domain\Entities\LoyaltyPointsRule;
use DateTime;

class LoyaltyPointsTransaction
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var LoyaltyAccount
     */
    private LoyaltyAccount $loyaltyAccount;

    /**
     * @var float
     */
    private float $pointsAmount;

    /**
     * @var null|float
     */
    private ?float $paymentAmount = null;

    /**
     * @var null|string
     */
    private ?string $paymentId = null;

    /**
     * @var null|\DateTime
     */
    private ?DateTime $paymentTime = null;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var null|LoyaltyPointsRule
     */
    private ?LoyaltyPointsRule $pointsRule = null;

    /**
     * @var int
     */
    private int $canceled = 0;

    /**
     * @var null|string
     */
    private ?string $cancelledReason = null;

    /**
     * @param string $id
     * @param LoyaltyAccount $loyaltyAccount
     * @param float $pointsAmount
     * @param float|null $paymentAmount
     * @param string|null $paymentId
     * @param DateTime|null $paymentTime
     * @param string $description
     * @param LoyaltyPointsRule|null $pointsRule
     * @param int $canceled
     * @param string|null $cancelledReason
     */
    public function __construct(string                    $id,
                                LoyaltyAccount            $loyaltyAccount,
                                float                     $pointsAmount,
                                string                    $description,
                                ?DateTime                 $paymentTime = null,
                                ?float                    $paymentAmount = null,
                                ?string                   $paymentId = null,
                                ?LoyaltyPointsRule $pointsRule = null,
                                int                       $canceled = 0,
                                ?string                   $cancelledReason = null)
    {
        $this->id = $id;
        $this->loyaltyAccount = $loyaltyAccount;
        $this->pointsAmount = $pointsAmount;
        $this->paymentAmount = $paymentAmount;
        $this->paymentId = $paymentId;
        $this->paymentTime = $paymentTime;
        $this->description = $description;
        $this->pointsRule = $pointsRule;
        $this->canceled = $canceled;
        $this->cancelledReason = $cancelledReason;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return LoyaltyAccount
     */
    public function getLoyaltyAccount(): LoyaltyAccount
    {
        return $this->loyaltyAccount;
    }

    /**
     * @return float
     */
    public function getPointsAmount(): float
    {
        return $this->pointsAmount;
    }

    /**
     * @return float|null
     */
    public function getPaymentAmount(): ?float
    {
        return $this->paymentAmount;
    }

    /**
     * @return string|null
     */
    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    /**
     * @return DateTime|null
     */
    public function getPaymentTime(): ?DateTime
    {
        return $this->paymentTime;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return LoyaltyPointsRule|null
     */
    public function getPointsRule(): ?LoyaltyPointsRule
    {
        return $this->pointsRule;
    }

    /**
     * @return int
     */
    public function getCanceled(): int
    {
        return $this->canceled;
    }

    /**
     * @return string|null
     */
    public function getCancelledReason(): ?string
    {
        return $this->cancelledReason;
    }

    /**
     * @param string $id
     * @param LoyaltyAccount $loyaltyAccount
     * @param float $pointsAmount
     * @param int|null $pointsRule
     * @param string $description
     * @param string $paymentId
     * @param float $paymentAmount
     * @param DateTime $paymentTime
     * @return LoyaltyPointsTransaction
     */
    public static function performPaymentLoyaltyPoints(string         $id,
                                                       LoyaltyAccount $loyaltyAccount,
                                                       float          $pointsAmount,
                                                       ?int           $pointsRule,
                                                       string         $description,
                                                       string         $paymentId,
                                                       float          $paymentAmount,
                                                       DateTime       $paymentTime): self
    {
        return new self(
            $id,
            $loyaltyAccount,
            $pointsAmount,
            $description,
            $paymentTime,
            $paymentAmount,
            $paymentId,
            $pointsRule
        );
    }

    /**
     * @param string $id
     * @param LoyaltyAccount $loyaltyAccount
     * @param float $pointsAmount
     * @param string $description
     * @param int $pointsRule
     * @return static
     */
    public static function withdrawLoyaltyPoints(string         $id,
                                                 LoyaltyAccount $loyaltyAccount,
                                                 float          $pointsAmount,
                                                 string         $description,
                                                 int            $pointsRule): self
    {
        return $loyaltyPointsTransaction = new self(
            $id,
            $loyaltyAccount,
            -$pointsAmount,
            $description,
            new DateTime(),
            null,
            null,
            $pointsRule
        );
    }
}
