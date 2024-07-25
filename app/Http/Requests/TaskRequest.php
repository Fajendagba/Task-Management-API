<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'description' => 'nullable|string',
            'due_date' => 'nullable|date_format:Y-m-d',
        ];

        // title rule only for POST requests (create task)
        if ($this->isMethod('post')) {
            $rules['title'] = 'required|string|max:255';
            $rules['status'] = 'required|in:pending,in_progress,completed';
        }

        // title rule only for POST requests (create task)
        if ($this->isMethod('put')) {
            $rules['title'] = 'nullable|string|max:255';
            $rules['status'] = 'nullable|in:pending,in_progress,completed';
        }

        return $rules;
    }

    /**
     * Custom messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'due_date.date_format' => 'The due date must be a valid date in the format YYYY-MM-DD.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
            'parameters' => $this->all(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
