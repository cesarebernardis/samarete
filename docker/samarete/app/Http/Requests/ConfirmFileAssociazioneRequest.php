<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmFileAssociazioneRequest extends FormRequest
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
            'file_ids' => 'string|required|max:150',
            'associazione_id' => 'integer|required|exists:associazione,id',
        ];
    }
}
