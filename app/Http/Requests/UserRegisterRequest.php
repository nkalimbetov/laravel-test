<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\DataTransferObjects\UserRegisterDTO;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    /**
     * @return \App\DataTransferObjects\UserRegisterDTO
     */
    public function getDTO(): UserRegisterDTO
    {
        return new UserRegisterDTO(
            $this->post('name'),
            $this->post('email'),
            $this->post('password'),
        );
    }
}
