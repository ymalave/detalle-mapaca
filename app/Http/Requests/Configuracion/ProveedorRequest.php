<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            'proveedor.rif' =>  $this->isMethod('POST') ? 'required|unique:proveedores,rif': 'required',
            'proveedor.nombre' => 'required',
            'proveedor.direccion' => 'required',
            'proveedor.telefono' => 'nullable',
            'proveedor.email' => 'nullable',
            'proveedor.cedula_representante' => 'nullable',
            'proveedor.nombre_representante' => 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        // Convierte el valor a mayúsculas
        $proveedor = $this->proveedor;
        $proveedor['rif'] = strtoupper($this->proveedor['rif']);

        $this->merge([
            'proveedor' => $proveedor,
        ]);
    }

    public function attributes()
    {
        return [
            'proveedor.rif' => 'Rif',
            'proveedor.nombre' => 'nombre',
            'proveedor.direccion' => 'direccion',
            'proveedor.telefono' => 'telefono',
            'proveedor.email' => 'correo electrónico',
            'proveedor.cedula_representante' => 'cedula',
            'proveedor.nombre_representante' => 'nombre ',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
