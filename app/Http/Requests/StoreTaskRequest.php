<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|unique:tasks,title',
            'description' => 'required|string|min:10',
            'due_date' => 'required|date|after:today',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:to_do,in_progress,done',
            'creator_id' => 'required|exists:users,id',
            'assignee_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.unique' => 'The title has already been taken.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.min' => 'The description must be at least 10 characters.',
            'due_date.required' => 'The due date field is required.',
            'due_date.date' => 'The due date must be a valid date.',
            'due_date.after' => 'The due date must be a date after today.',
            'priority.required' => 'The priority field is required.',
            'priority.in' => 'The priority must be one of the following: low, medium, high, urgent.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of the following: to_do, in_progress, done.',
            'creator_id.required' => 'The creator field is required.',
            'creator_id.exists' => 'The selected creator does not exist.',
            'assignee_id.required' => 'The assignee field is required.',
            'assignee_id.exists' => 'The selected assignee does not exist.',
        ];
    }
}
