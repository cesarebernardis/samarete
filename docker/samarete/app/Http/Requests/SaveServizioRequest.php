<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\UserRepository;

class SaveServizioRequest extends FormRequest
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
            'id' => 'integer|nullable|exists:evento,id',
            'nome' => 'string|required|max:100',
            'oggetto' => 'string|nullable|max:200',
            'descrizione' => 'string|nullable',
            'periodicita' => 'string|nullable',
            'data_fine' => 'date_format:d/m/Y|after_or_equal:today|nullable',
            'logo' => 'integer|nullable|exists:file,id',
            'new_logo' => 'integer|nullable|exists:file_tmp,id',
            'giorno' => 'array',
            'giorno.data.*' => 'date_format:d/m/Y|after_or_equal:today',
            'giorno.da.*' => 'date_format:H:i',
            'giorno.a.*' => 'date_format:H:i',
            'giorno.descrizione.*' => 'string|max:200',
            'creatore_id' => 'integer|required|exists:associazione,id',
        ];
    }
}
