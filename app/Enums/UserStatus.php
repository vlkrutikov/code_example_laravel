<?php

declare(strict_types=1);

namespace App\Enums;

use Konekt\Enum\Enum;

/**
 * Class UserStatus
 * @package App\Enums
 */
final class UserStatus extends Enum
{
    public const __DEFAULT = self::STATUS_ENABLED;

    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 2;
}
