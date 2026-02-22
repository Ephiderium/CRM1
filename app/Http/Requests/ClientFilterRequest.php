<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFilterRequest extends FormRequest
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
            'name' => 'nullable|string|min:2',
            'email' => 'nullable|email|string',
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'source' => 'nullable|string|in:advertising,call,site',
            'manager_id' => 'nullable|integer',
            'status' => 'nullable|string|in:new,active,archived',
        ];
    }
}
