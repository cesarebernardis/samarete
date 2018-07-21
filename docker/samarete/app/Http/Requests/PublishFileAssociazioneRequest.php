<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishFileAssociazioneRequest extends FormRequest
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
            'file_id' => 'integer|required|exists:file,id',
            'associazione_id' => 'integer|required|exists:associazione,id',
            'public' => 'boolean|nullable',
        ];
    }
}
