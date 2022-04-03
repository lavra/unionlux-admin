<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $slug = $this->segment(2);
        $rules = [
            'name' => ['required', 'min:3', "unique:categories,name,{$slug},slug"],
            'description' => ['required', 'min:10', 'max:500'],
            'image' => ['required', 'image'],
            'order' => ['required', 'numeric'],
        ];
        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }
        
        return $rules;
    }
    
    public function messages()
    {
        $message = [
            'image.required' => 'A imagem é obrigatória.',
            'image.image' => 'O campo foto deverá conter uma imagem.',
            'name.required' => 'O nome é obrigatório.',
            'name.unique' => 'Este nome já está em uso.',
            'description.required' => 'A descrição é obrigatória.',
            'description.min' => 'A descrição deverá conter no mínimo 10 caracteres.',
            'description.max' => 'A descrição não deverá conter mais de 500 caracteres.',
            'order.required' => 'A ordem é obrigatória.',
            'order.numeric' => 'A ordem deverá conter no mínimo 1 número inteiro.',
        ];
        
        return $message;
    }
    
}
