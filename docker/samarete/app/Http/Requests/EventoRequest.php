<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\EventoRepository;

use Samarete\Models\Evento;

class EventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:evento,id',
        ];
    }
    
    public function evento()
    {
        if(empty($this->id)) return Evento::class;
        return EventoRepository::getById($this->id);
    }

}