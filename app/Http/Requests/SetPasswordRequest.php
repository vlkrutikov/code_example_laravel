<?php

declare(strict_types=1);

namespace App\Http\Requests;

/**
 * Class SetPasswordRequest
 * @package App\Http\Requests
 */
class SetPasswordRequest extends ApiRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'email' => 'email',
            'vat_number' => 'max:13',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
