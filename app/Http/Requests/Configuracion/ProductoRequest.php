<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'cod_producto' => $this->isMethod('PUT') ? 'required': 'nullable',
            'cod_proveedor' => 'required',
            'nombre' => 'required',
            'marca' => 'required',
            'precio_venta' => 'required',
            'precio_proveedor' => 'required',


            'nombre_proveedor' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'cod_producto' => 'Cod. Producto',
            'cod_proveedor' => 'Cod. Proveedor',
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'precio_venta' => 'precio venta',
            'precio_proveedor' => 'precio proveedor',

            'nombre_proveedor' => 'Nombre proveedor'
        ];
    }

    public function messages()
    {
        return [
            'cod_producto.required' => 'La :attribute es obligatoria.',
            'cod.proveedor.required' => 'El :attribute es obligatorio.',
            'nombre.required' => 'El campo :attribute es obligatorio',
            'marca.required' => 'El campo :attribute es obligatorio',
            'precio_venta.required' => 'El campo :attribute es obligatorio',
            'precio_proveedor.required' => 'El campo :attribute es obligatorio',
            'nombre_proveedor.required' => 'El campo :attribute es obligatorio',
        ];
    }
}
