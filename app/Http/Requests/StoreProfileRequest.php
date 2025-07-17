<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'name' => 'string|max:255',
            'email' => 'email|max:255|',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'profile_picture'=>'required|image|mimes:jpg,png,jpeg,gif|max:2048'
        ];
    }
}
