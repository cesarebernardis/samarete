<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\RichiestaRequest;

class EditRichiestaRequest extends RichiestaRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:richiesta,id',
        ];
    }
    
}
