<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
           'email' => ['required','email','unique:users,email'],
           'phone_number' => ['required','unique:users,phone_number', 'regex:/^[0-9]{10,15}$/'],
           'username' => ['required','unique:users,username'],
           'password' => 'required|string|min:6|confirmed',
           'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           'certificate' => 'required|mimes:pdf|max:10000',
        ];
    }
}
