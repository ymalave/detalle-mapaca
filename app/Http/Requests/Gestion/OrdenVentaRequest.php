<?php

namespace App\Http\Requests\Gestion;

use Illuminate\Foundation\Http\FormRequest;

class OrdenVentaRequest extends FormRequest
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
            'cedula_cliente' =>  'required',
            'nro_cliente' =>  'required',
            'nombre_cliente' => 'required',
            'nombre_usuario' => 'required',
            'fecha_solicitud' => 'required',
            'monto_total' => 'required',
            'monto_total_bs' => 'required',

            'venta_detalle.*.nro_venta' => 'nullable',
            'venta_detalle.*.cod_producto' => 'required',
            'venta_detalle.*.cantidad' => 'required',
            'venta_detalle.*.monto' => 'required',
            'venta_detalle.*.monto_bs' => 'required',

        ];
    }

    public function attributes()
    {
        return [
            'nro_venta' =>  'Nro. fact',
            'cedula_cliente' => 'Cedula cliente',
            'nombre_cliente' => 'cliente',
            'fecha_solicitud' => 'fecha solicitud',

            'venta_detalle.*.nro_pedido' => 'Nro. Pedido',
            'venta_detalle.*.cod_producto' => 'Cod. Proveedor',
            'venta_detalle.*.cantidad' => 'cantidad',
            'venta_detalle.*.monto' => 'monto',
            'venta_detalle.*.recibido' => 'recibido',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
