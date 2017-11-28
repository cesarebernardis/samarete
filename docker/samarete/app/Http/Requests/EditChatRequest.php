<?php

namespace Samarete\Http\Requests;

use Samarete\Http\Requests\ChatRequest;

class EditChatRequest extends ChatRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:chat,id',
        ];
    }
    
}
