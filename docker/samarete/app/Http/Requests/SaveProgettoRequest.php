<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\UserRepository;

class SaveProgettoRequest extends FormRequest
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
            'id' => 'integer|nullable|exists:progetto,id',
            'nome' => 'string|required|max:100',
            'oggetto' => 'string|nullable|max:200',
            'descrizione' => 'string|nullable',
            'logo' => 'integer|nullable|exists:file,id',
            'new_logo' => 'integer|nullable|exists:file_tmp,id',
            'creatore_id' => 'integer|required|exists:associazione,id',
        ];
    }
}
