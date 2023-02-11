<?php

declare(strict_types=1);

namespace App\Actions;

use App\Contracts\Actions\CreateUserInterface;
use App\Models\User;
use App\Dto\User\CreateUserDto;

/**
 * New User creator
 *
 * Class CreateUser
 * @package App\Actions
 */
class CreateUser implements CreateUserInterface
{
    /**
     * @inheritDoc
     */
    public function create(CreateUserDto $input): User
    {
        return User::create([
            'first_name' => $input->first_name,
            'last_name' => $input->last_name,
            'email' => $input->email,
            'password' => \Hash::make($input->password),
        ]);
    }
}
