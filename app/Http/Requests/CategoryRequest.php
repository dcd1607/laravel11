<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $imageRules = 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        if($this->isMethod('post')){
            $imageRules = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return [
            'name' => ['required','string','max:255', Rule::unique('categories')->ignore($this->route('category'))],
            'description' => 'required|string|max:2000',
            'image' => $imageRules,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'La categoria es requerida',
            'name.string' => 'La categoria debe ser un texto',
            'name.max' => 'La categoria no debe ser mayor a :max caracteres',
            'name.unique' => 'La categoria ya existe',
            'description.required' => 'La descripción es requerida',
            'description.string' => 'Descripción debe ser un texto',
            'description.max' => 'La descripción no debe ser mayor a :max caracteres',
            'image.image' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'La imagen no debe ser mayor a 2048 kilobytes',
        ];
    }
}
