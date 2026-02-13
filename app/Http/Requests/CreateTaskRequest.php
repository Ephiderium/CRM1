<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'title' => 'required|string|min:2',
            'description' => 'required|string|min:2',
            'assigned_to' => 'required|integer|exists:users,id',
            'related_type' => 'required|string|in:client,deal',
            'related_id' => 'required|integer',
            'due_date' => 'required|string',
            'status' => 'required|in:new,progress,done,overdue',
        ];
    }
}
