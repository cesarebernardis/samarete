<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\ProgettoRequest;

class EditProgettoRequest extends ProgettoRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:progetto,id',
        ];
    }
    
}
