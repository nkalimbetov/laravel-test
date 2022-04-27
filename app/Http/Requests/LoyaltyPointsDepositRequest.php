<?php

namespace App\Http\Requests;

use App\DataTransferObjects\LoyaltyPointsDepositDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoyaltyPointsDepositRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_id' => 'required|string',
            'account_type' => 'required|in:phone,email,card',
            'loyalty_points_rule' => 'required|string',
            'description' => 'required|string',
            'payment_id' => 'required|string',
            'payment_amount' => 'required|float',
            'payment_time' => 'required|integer',
        ];
    }

    /**
     * @return LoyaltyPointsDepositDTO
     */
    public function getDTO(): LoyaltyPointsDepositDTO
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp($this->post('payment_time'));
        return new LoyaltyPointsDepositDTO(
            $this->post('account_id'),
            $this->post('account_type'),
            $this->post('loyalty_points_rule'),
            $this->post('description'),
            $this->post('payment_id'),
            $this->post('payment_amount'),
            $dateTime,
        );
    }
}
