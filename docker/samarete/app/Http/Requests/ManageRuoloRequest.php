<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageRuoloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*TODO check permissions*/
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
            'user_id' => 'integer|required|exists:users,id',
            'ruolo_id' => 'integer|required|exists:ruolo,id',
        ];
    }
}
