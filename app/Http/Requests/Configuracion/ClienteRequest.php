<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'cliente.cedula_cliente' => $this->isMethod('POST') ? 'required|unique:clientes,cedula_cliente': 'required',
            'cliente.nombres' => 'required',
            'cliente.apellidos' => 'required',
            'cliente.direccion' => 'nullable',
            'cliente.nro_telefono' => 'nullable',
            'cliente.email' => 'nullable',
            'cliente.sexo' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'cliente.cedula_cliente' => 'cedula del cliente',
            'cliente.nombres' => 'nombres',
            'cliente.apellidos' => 'apellidos',
            'cliente.direccion' => 'direccion',
            'cliente.nro_telefono' => 'nro_telefono',
            'cliente.email' => 'email',
            'cliente.sexo' => 'sexo',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
