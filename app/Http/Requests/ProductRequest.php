<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'decimal:0,2', 'max:999999.99', 'min:0.01'],
            'gender' => ['required', Rule::in(['male', 'female', 'unisex'])],
            'size' => ['required', Rule::in(['xs', 's', 'm', 'l', 'xl'])],
            'brand_id' => ['required', Rule::exists('brands', 'id')],
            'color_id' => ['required', Rule::exists('colors', 'id')],
            'type_id' => ['required', Rule::exists('types', 'id')],
            "image" => ["required", File::image()]
        ];
    }
}
