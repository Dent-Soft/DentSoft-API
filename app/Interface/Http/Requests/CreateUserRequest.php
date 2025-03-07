<?php

namespace App\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email',
            'phone1'             => 'required|string|max:255',
            'phone2'             => 'nullable|string|max:255',
            'address'            => 'required|string|max:255',
            'emergency_contacts' => 'nullable|array',
            'birth_date'         => 'required|date_format:Y-m-d',
            'password'           => 'required|string|min:8',
        ];
    }
}
