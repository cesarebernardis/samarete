<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\UserRepository;

class SaveRichiestaRequest extends FormRequest
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
            'id' => 'integer|nullable|exists:richiesta,id',
            'contatto_1' => 'string|required|max:100',
            'contatto_2' => 'string|nullable|max:100',
            'oggetto' => 'string|required|max:200',
            'testo' => 'string|required',
            'globale' => 'boolean|nullable',
            'associazioni' => 'array',
            'associazioni.*' => 'integer|required|exists:associazione,id',
        ];
    }
}
