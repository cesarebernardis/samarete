<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

use Samarete\Repositories\UserRepository;

class SaveUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return UserRepository::checkPermission(Auth::user(), 'edit-user');
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
            'username' => 'string|required|max:100',
            'password' => 'string|max:100',
            'conferma_password' => 'string|max:100',
            'email' => 'string|required|max:100',
            'nome' => 'string|required|max:100',
            'cognome' => 'string|required|max:100',
        ];
    }
}
