<?php

declare(strict_types=1);

namespace App\Http\Requests;

/**
 * Class PatchProfileRequest
 * @package App\Http\Requests
 */
class PatchProfileRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'unique:users,email'],

            'old_password' => ['sometimes', 'required', 'string', 'max:255'],
            'new_password' => ['required', 'string', 'max:255', 'different:old_password'],
        ];
    }

    /**
     * @param  array  $rules
     * @param  mixed  ...$params
     * @return array|void
     */
    public function validate(array $rules, ...$params)
    {
        parent::validate($rules, $params);
    }
}
