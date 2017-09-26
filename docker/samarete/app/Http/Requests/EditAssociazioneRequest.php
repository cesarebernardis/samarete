<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\AssociazioneRequest;

class EditAssociazioneRequest extends AssociazioneRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:associazione,id',
        ];
    }
    
}
