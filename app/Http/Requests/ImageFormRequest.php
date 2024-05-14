<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageFormRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'description' => ['required', 'string'],
        ];
        
        // If the request is for updating an existing image, make the image field optional
        if ($this->isMethod('put')) {
        $rules['image'] = ['nullable', 'image', 'mimes:png,jpg,jpeg'];
        } else {
        // For other methods (e.g., POST), keep the image field required
        $rules['image'] = ['required', 'image', 'mimes:png,jpg,jpeg'];
    }
    return $rules;
}

    public function messages(): array
    {
       return [
            'name.min' => 'Give at least 3 character!',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The uploaded image must be a PNG, JPG, or JPEG file.', 
        ];
    }
}
