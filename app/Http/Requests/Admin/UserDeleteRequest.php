<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\ServiceProvider;

class UserDeleteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

}
