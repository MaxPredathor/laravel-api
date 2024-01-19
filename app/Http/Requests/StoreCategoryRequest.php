<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string', 'unique:categories'],
        ];
    }
    public function messages(){
        return [
            'name.unique' => 'Il titolo deve essere univoco',
            'name.required' => 'Il titolo è obbligatorio',
            'name.max' => 'Il titolo non deve superare i :max caratteri'
        ];
    }
}
