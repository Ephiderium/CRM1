<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDealRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'manager_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'stage' => 'required|in:new,in_progress,won,lost',
            'expacted_close_date' => 'required|string',
        ];
    }
}
