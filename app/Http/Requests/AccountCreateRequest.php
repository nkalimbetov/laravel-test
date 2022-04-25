<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\AccountCreateDTO;
use Illuminate\Foundation\Http\FormRequest;

class AccountCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string',
            'card' => 'required|string',
            'email' => 'required|email',
            'email_notification' => 'required|boolean',
            'phone_notification' => 'required|boolean',
            'active' => 'required|boolean',
        ];
    }

    /**
     * @return AccountCreateDTO
     */
    public function getDTO(): AccountCreateDTO
    {
        return new AccountCreateDTO(
            $this->post('phone'),
            $this->post('card'),
            $this->post('email'),
            $this->boolean('email_notification'),
            $this->boolean('phone_notification'),
            $this->boolean('active'),
        );
    }
}
