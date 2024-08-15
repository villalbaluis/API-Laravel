<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes | string | max:255',
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => 'sometimes | string | min:8 | confirmed',
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