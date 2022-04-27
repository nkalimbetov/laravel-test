<?php

namespace App\Domain\Aggregates;

class LoyaltyAccount
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $card;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var bool
     */
    private bool $emailVerification;

    /**
     * @var bool
     */
    private bool $phoneVerification;

    /**
     * @var bool
     */
    private bool $active;

    /**
     * @param string $id
     * @param string $phone
     * @param string $card
     * @param string $email
     * @param bool $emailVerification
     * @param bool $phoneVerification
     * @param bool $active
     */
    public function __construct(string $id, string $phone, string $card, string $email, bool $emailVerification, bool $phoneVerification, bool $active)
    {
        $this->id = $id;
        $this->phone = $phone;
        $this->card = $card;
        $this->email = $email;
        $this->emailVerification = $emailVerification;
        $this->phoneVerification = $phoneVerification;
        $this->active = $active;
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
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCard(): string
    {
        return $this->card;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isEmailVerification(): bool
    {
        return $this->emailVerification;
    }

    /**
     * @return bool
     */
    public function isPhoneVerification(): bool
    {
        return $this->phoneVerification;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return void
     */
    public function activate(): void
    {
        $this->active = true;
    }

    /**
     * @return void
     */
    public function deactivate(): void
    {
        $this->active = false;
    }
}
