<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\ServizioRequest;

class ViewServizioCalendarRequest extends ServizioRequest
{
    
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:servizio,id',
            'start' => 'required|date_format:Y-m-d',
            'end' => 'required|date_format:Y-m-d',
        ];
    }
    
}
