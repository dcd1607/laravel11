<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRules = 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        if ($this->isMethod('post')) {
            $imageRules = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('wines', 'name')->ignore($this->route('wine'))],
            'description' => ['required', 'string', 'max:2000'],
            'category_id' => ['required', 'exists:categories,id'],
            'year' => ['required', 'integer', 'min:' . now()->subYears(100)->year, 'max:' . now()->year],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => $imageRules,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del vino es requerido',
            'name.string' => 'El nombre del vino debe ser un texto',
            'name.max' => 'El nombre del vino no debe ser mayor a :max caracteres',
            'name.unique' => 'El nombre del vino ya existe',
            'description.required' => 'La descripción es requerida',
            'description.string' => 'La descripción debe ser un texto',
            'description.max' => 'La descripción no debe ser mayor a :max caracteres',
            'category_id.required' => 'La categoría es requerida',
            'category_id.exists' => 'La categoría no existe',
            'year.required' => 'El año es requerido',
            'year.integer' => 'El año debe ser un número entero',
            'year.min' => 'El año no debe ser menor a :min',
            'year.max' => 'El año no debe ser mayor a :max',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
            'price.min' => 'El precio no debe ser menor a :min',
            'stock.required' => 'El stock es requerido',
            'stock.integer' => 'El stock debe ser un número entero',
            'stock.min' => 'El stock no debe ser menor a :min',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'image.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'La imagen no debe ser mayor a 2048 kilobytes',
        ];
    }
}