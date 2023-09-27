<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'body' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
