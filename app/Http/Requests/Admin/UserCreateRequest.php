<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\ServiceProvider;

class UserCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string'],
            'organizer' => ['boolean']
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->organizer == 'true') {
            $this->merge(['organizer' => true]);
        }else{
            $this->merge(['organizer' => false]);
        }
    }
}
