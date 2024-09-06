<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;


class StoreGrades extends FormRequest
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
         //  'Name' => 'required|unique:posts|max:255',
           'Name' => 'required',
            // 'Name.*' => ['required', UniqueTranslationRule::for('grades')], 
            
            // 'Notes' => 'required',
            // 'Name_en'=>'required',
        ];
    }

    public function messages(): array
{
    return [
        'Name.required' => trans('validation.required'),
        // 'Notes.required' => 'A Notes is required',
        // 'Name_en.required' => 'A Name_en is required',

    ];
}
}
