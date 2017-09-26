<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\AssociazioneRepository;

use Samarete\Models\Associazione;

class AssociazioneRequest extends FormRequest
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
            'id' => 'required|integer|exists:associazione,id',
        ];
    }
    
    public function associazione()
    {
        if(empty($this->id)) return Associazione::class;
        return AssociazioneRepository::getById($this->id);
    }

}