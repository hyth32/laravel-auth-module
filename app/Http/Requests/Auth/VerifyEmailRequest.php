<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function validationData(): array
    {
        return [
            ...$this->all(),
            'id' => $this->route('id'),
            'hash' => $this->route('hash'),
        ];
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'hash' => ['required', 'string', 'size:40'],
        ];
    }
}
