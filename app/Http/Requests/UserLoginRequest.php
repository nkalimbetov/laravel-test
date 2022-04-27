<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\UserLoginDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    /**
     * @return \App\DataTransferObjects\UserLoginDTO
     */
    public function getDTO(): UserLoginDTO
    {
        return new UserLoginDTO($this->post('email'), $this->post('password'));
    }
}
