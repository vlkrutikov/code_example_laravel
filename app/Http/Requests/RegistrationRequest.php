<?php

declare(strict_types=1);

namespace App\Http\Requests;

/**
 * Class RegistrationRequest
 * @package App\Http\Requests
 */
class RegistrationRequest extends ApiRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }
}
