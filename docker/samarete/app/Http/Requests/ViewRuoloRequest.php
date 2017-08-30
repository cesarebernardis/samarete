<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;

class ViewRuoloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
        return UserRepository::checkPermesso('view-ruolo');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|required|exists:ruolo,id',
        ];
    }
}
