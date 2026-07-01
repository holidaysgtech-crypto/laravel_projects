<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreQRCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:1000'],
            'size' => ['required', 'integer', 'min:100', 'max:1000'],
            'foreground_color' => ['required', 'string', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'background_color' => ['required', 'string', 'regex:/^#[0-9a-fA-F]{6}$/'],

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            
            'content.required' => 'The content field is required.',
           
            'content.max' => 'The content may not be greater than 1000 characters.',
            
            'size.min' => 'The size must be at least 100.',
            'size.max' => 'The size may not be greater than 1000.',
            'foreground_color.required' => 'The foreground color field is required.',
            'foreground_color.string' => 'The foreground color must be a string.',
            'foreground_color.regex' => 'The foreground color format is invalid. It should be a valid hex color code (e.g., #000000).',
            'background_color.required' => 'The background color field is required.',
            'background_color.string' => 'The background color must be a string.',
            'background_color.regex' => 'The background color format is invalid. It should be a valid hex color code (e.g., #FFFFFF).',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    
}
