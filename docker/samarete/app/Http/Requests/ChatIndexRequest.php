<?php

namespace Samarete\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Samarete\Repositories\UserRepository;
use Samarete\Repositories\ChatRepository;

use Samarete\Models\Chat;

class ChatIndexRequest extends FormRequest
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
            'id' => 'nullable|integer|exists:chat,id',
        ];
    }
    
    public function chat()
    {
        if(empty($this->id)) return null;
        return ChatRepository::getById($this->id);
    }
}
