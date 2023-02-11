<?php

namespace App\Contracts\Actions;

use App\Models\User;
use App\Dto\User\CreateUserDto;

/**
 * Interface CreateUser
 * @package App\Contracts\Actions
 */
interface CreateUserInterface
{
    /**
     * Create a newly registered user
     *
     * @param  CreateUserDto  $input
     * @return User
     */
    public function create(CreateUserDto $input): User;
}
