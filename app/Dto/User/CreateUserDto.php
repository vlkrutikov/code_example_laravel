<?php

declare(strict_types=1);

namespace App\Dto\User;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class CreateUserDto
 * @package App\Models\User
 */
class CreateUserDto extends DataTransferObject
{
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
}
