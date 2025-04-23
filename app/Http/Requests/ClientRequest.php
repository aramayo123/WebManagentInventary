<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Client;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'nombre' => 'required|string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('clients', 'email')->ignore($this->route('cliente')),
            ],
            'password' => 'required',
            'licencia_expires_at' => 'nullable|date',
        ];
    }
    public function attributes()
    {
        return [
            'licencia_expires_at' => 'vencimiento',
            'password' => 'contraseña',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre no debe contenerr numeros o caracteres especiales.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un email valido.',
            'email.unique' => 'El email ya existe en nuestros registros.',
            'password.required' => 'La contraseña es obligatoria.',
            'licencia_expires_at.date' => 'El vencimiennto debe ser una fecha.',
        ];
    }
}
