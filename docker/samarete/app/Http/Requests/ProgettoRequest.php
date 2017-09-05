<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\ProgettoRepository;

use Samarete\Models\Progetto;

class ProgettoRequest extends FormRequest
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
            'id' => 'required|integer|exists:progetto,id',
        ];
    }
    
    public function progetto()
    {
        if(empty($this->id)) return Progetto::class;
        return ProgettoRepository::getById($this->id);
    }

}