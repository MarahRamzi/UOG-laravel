<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required |email',
            'first_name' => 'min:3 | max:15',
            'last_name' => 'min:3 | max:15',
            'is_active' => 'required|in:0,1',
             'phone'    => ['required' ,'regex:/^\+?[0-9]{8,}$/'],
        ];
    }
}
