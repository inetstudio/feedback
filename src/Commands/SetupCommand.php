<?php

namespace InetStudio\Feedback\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'inetstudio:feedback:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup feedback package';

    /**
     * Commands to call with their description.
     *
     * @var array
     */
    protected $calls = [];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initCommands();

        foreach ($this->calls as $info) {
            if (! isset($info['command'])) {
                continue;
            }

            $this->line(PHP_EOL.$info['description']);
            $this->call($info['command'], $info['params']);
        }
    }

    /**
     * Инициализация команд.
     *
     * @return void
     */
    private function initCommands()
    {
        $this->calls = [
            [
                'description' => 'Publish migrations',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\Feedback\FeedbackServiceProvider',
                    '--tag' => 'migrations',
                ],
            ],
            [
                'description' => 'Migration',
                'command' => 'migrate',
                'params' => [],
            ],
            [
                'description' => 'Publish public',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\Feedback\FeedbackServiceProvider',
                    '--tag' => 'public',
                    '--force' => true,
                ],
            ],
            [
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\Feedback\FeedbackServiceProvider',
                    '--tag' => 'config',
                ],
            ],
        ];
    }
}
