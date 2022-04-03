<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        
    
        $password = $this->get('password');
        $whatsapp = $this->get('whatsapp');
        
        
        if (isset($whatsapp) && $whatsapp == 1) {
            $rules['message_whatsapp']  = "required";
        }
    
        if (!empty($password)) {
            $rules['password']  = "required|string|min:8|confirmed";
        }
        $rules['name']    = "required";
        $rules['email']   = "required|unique:users,email,{$this->segment(2)},id";
        $rules['phone']   = "required|unique:users,phone,{$this->segment(2)},id";
    
    
        return $rules;
    }
    
    
    public function messages()
    {
        $messages = [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'email.unique' => 'Este email já existe cadastrado.',
            'phone.required' => 'O telefone é obrigatório',
            'phone.unique' => 'Este telefone já foi cadastrado.',
            'message_whatsapp.required' => 'A mensagem do Whatsapp é obrigatŕia',
        ];
        
        return $messages;
    }
}
