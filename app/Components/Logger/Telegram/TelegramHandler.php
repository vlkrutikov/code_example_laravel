<?php

declare(strict_types=1);

namespace App\Components\Logger\Telegram;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Class TelegramHandler
 * @package App\Logger\Telegram
 */
class TelegramHandler extends AbstractProcessingHandler
{
    /**
     * Bot API token
     *
     * @var string
     */
    private $botToken;

    /**
     * Chat id for bot
     *
     * @var int
     */
    private $chatId;

    /**
     * Application name
     *
     * @var string
     */
    private $appName;

    /**
     * Application environment
     *
     * @var string
     */
    private $appEnv;

    /**
     * TelegramHandler constructor.
     * @param  int|string  $level
     */
    public function __construct($level)
    {
        $level = Logger::toMonologLevel($level);

        parent::__construct($level, true);

        // define variables for making Telegram request
        $this->botToken = config('telegram-logger.token');
        $this->chatId = config('telegram-logger.chat_id');

        // define variables for text message
        $this->appName = config('app.name');
        $this->appEnv = config('app.env');
    }

    /**
     * @param  array  $record
     */
    public function write(array $record): void
    {
        if (!$this->botToken || !$this->chatId) {
            return;
        }

        // trying to make request and send notification
        try {
            file_get_contents(
                'https://api.telegram.org/bot' . $this->botToken . '/sendMessage?'
                . http_build_query(
                    [
                        'text' => $this->formatText($record['formatted'], $record['level_name']),
                        'chat_id' => $this->chatId,
                        'parse_mode' => 'html'
                    ]
                )
            );
        } catch (\Exception $exception) {
        }
    }

    /**
     * @param  string  $text
     * @param  string  $level
     *
     * @return string
     */
    private function formatText(string $text, string $level): string
    {
        return '<b>' . $this->appName . '</b> (' . $level . ')' . PHP_EOL . 'Env: ' . $this->appEnv . PHP_EOL . $text;
    }
}
