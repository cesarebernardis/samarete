<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;

class ViewUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return UserRepository::checkPermesso('view-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|required|exists:users,id',
        ];
    }
}
