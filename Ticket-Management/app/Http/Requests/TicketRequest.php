<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'titles' => ['required', 'min:5', 'max:255', 'string'],
            'description' => ['required', 'min:15', 'max:255'],
            'labels' => ['required'],
            'categories' => ['required'],
            'priority' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'titles.required' => 'Please enter this ticket title field...',
            'titles.min' => 'Title field required atleast 5 character...',
            'titles.string' => 'Title field should contain only string value...',
            'titles.unique' => 'Title is already exists...',
            'description.required' => 'Please enter the message field...',
            'description.min' => 'Message field required atleast 15 character...',
            'labels.required' => 'Please tick this label field...',
            'categories.required' => 'Please tick this category field...',
            'priority.required' => 'Please choose this priority field...',
        ];
    }
}
