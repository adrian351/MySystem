<?php

namespace App\Http\Requests\produccion\pedidoActivo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoActivoArmadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return [
            'ubicacion_rack'          => 'required|max:50|min:1|string',
          ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
