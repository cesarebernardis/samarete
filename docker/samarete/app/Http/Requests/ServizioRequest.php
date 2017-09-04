<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\ServizioRepository;

use Samarete\Models\Servizio;

class ServizioRequest extends FormRequest
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
            'id' => 'required|integer|exists:servizio,id',
        ];
    }
    
    public function servizio()
    {
        if(empty($this->id)) return Servizio::class;
        return ServizioRepository::getById($this->id);
    }

}