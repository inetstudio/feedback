<?php

namespace InetStudio\FeedbackPackage\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:feedback-package:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup feedback package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Feedback setup',
                'command' => 'inetstudio:feedback-package:feedback:setup',
            ],
        ];
    }
}
