<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;

class ViewAssociazioneRequest extends FormRequest
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
            'id' => 'integer|required|exists:associazione,id',
        ];
    }
}
