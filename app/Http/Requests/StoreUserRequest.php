<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required | string | max:255',
            'email' => 'required |string | email | max:255 | unique:users',
            'password' => 'required | string | min:8 | confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'nombre']),
            'email.required' => __('validation.required', ['attribute' => 'correo electrónico']),
            'email.email' => __('validation.email', ['attribute' => 'correo electrónico']),
            'email.unique' => __('validation.unique', ['attribute' => 'correo electrónico']),
            'password.required' => __('validation.required', ['attribute' => 'contraseña']),
            'password.min' => __('validation.min.string', ['attribute' => 'contraseña', 'min' => 8]),
            'password.confirmed' => __('validation.confirmed', ['attribute' => 'contraseña']),
        ];
    }
}