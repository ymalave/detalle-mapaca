<?php

namespace App\Http\Requests\Gestion;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'nro_pedido' =>  $this->isMethod('PUT') ? 'required|unique:pedido': 'nullable',
            'cod_proveedor' => 'required',
            'nombre_proveedor' => 'required',
            'fecha_solicitud' => 'required',
            'fecha_recepcion' => 'nullable',
            'cerrado' => 'nullable',

            'producto_pedido.*.nro_pedido' => 'nullable',
            'producto_pedido.*.cod_producto' => 'nullable',
            'producto_pedido.*.cantidad' => 'nullable',
            'producto_pedido.*.monto' => 'nullable',
            'producto_pedido.*.recibido' => 'nullable',

        ];
    }

    public function attributes()
    {
        return [
            'nro_pedido' =>  'Nro. Pedido',
            'cod_proveedor' => 'Cod. Proveedor',
            'nombre_proveedor' => 'proveedor',
            'fecha_solicitud' => 'fecha solicitud',
            'fecha_recepcion' => 'fecha recep',
            'cerrado' => 'cerrado',

            'producto_pedido.*.nro_pedido' => 'Nro. Pedido',
            'producto_pedido.*.cod_producto' => 'Cod. Proveedor',
            'producto_pedido.*.cantidad' => 'cantidad',
            'producto_pedido.*.monto' => 'monto',
            'producto_pedido.*.recibido' => 'recibido',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
