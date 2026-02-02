<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'string|nullable|min:2',
            'email' => 'email|nullable',
            'phone' => 'string|nullable|unique:clients,email',
            'company' => 'string|nullable',
            'source' => 'string|nullable,in:advertising,call,site',
            'manager_id' => 'integer|nullable|exists:users,id',
            'status' => 'string|nullable|in:new,active,archived'
        ];
    }
}
