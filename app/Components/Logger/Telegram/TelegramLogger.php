<?php

namespace App\Components\Logger\Telegram;

use Monolog\Logger;

/**
 * Class TelegramLogger
 * @package App\Logger\Telegram
 */
class TelegramLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        return new Logger(
            config('app.name'),
            [
                new TelegramHandler($config['level'])
            ]
        );
    }
}
