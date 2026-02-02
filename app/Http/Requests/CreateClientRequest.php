<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'name' => 'string|required|min:2',
            'email' => 'email|required',
            'phone' => 'string|required|unique:clients,email',
            'company' => 'string|required',
            'source' => 'string|required,in:advertising,call,site',
            'manager_id' => 'integer|required|exists:users,id',
            'status' => 'string|required|in:new,active,archived'
        ];
    }
}
