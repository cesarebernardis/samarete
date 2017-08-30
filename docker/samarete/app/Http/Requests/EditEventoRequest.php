<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\EventoRequest;

class EditEventoRequest extends EventoRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:evento,id',
        ];
    }
    
}
