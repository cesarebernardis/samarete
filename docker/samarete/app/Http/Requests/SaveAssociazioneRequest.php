<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\UserRepository;

class SaveAssociazioneRequest extends FormRequest
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
            'id' => 'integer|nullable',
            'nome' => 'string|required|max:200',
            'acronimo' => 'string|nullable|max:45',
            'indirizzo' => 'string|nullable|max:200',
            'telefono_1' => 'string|nullable|max:20',
            'telefono_2' => 'string|nullable|max:20',
            'referente_nome' => 'string|nullable|max:100',
            'referente_indirizzo' => 'string|nullable|max:200',
            'referente_telefono_1' => 'string|nullable|max:20',
            'referente_telefono_2' => 'string|nullable|max:20',
            'email' => 'string|nullable|max:100',
            'sito_web' => 'string|nullable|max:100',
            'descrizione' => 'string|nullable',
            'new_logo' => 'integer|nullable|exists:file_tmp,id',
            'logo' => 'integer|nullable|exists:file,id',
            'gestore_id' => 'integer|exists:users,id',
        ];
    }
}
