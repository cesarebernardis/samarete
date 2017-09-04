<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\ServizioRequest;

class EditServizioRequest extends ServizioRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:servizio,id',
        ];
    }
    
}
