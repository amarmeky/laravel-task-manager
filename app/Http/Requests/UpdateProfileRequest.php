<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'user_id'=>'exists:users,id|unique:profiles,user_id',
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500'
        ];
    }
}
