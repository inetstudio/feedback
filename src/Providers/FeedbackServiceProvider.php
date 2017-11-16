<?php

namespace InetStudio\Feedback\Providers;

use Illuminate\Support\ServiceProvider;
use InetStudio\Feedback\Models\FeedbackModel;
use InetStudio\Feedback\Observers\FeedbackObserver;
use InetStudio\Feedback\Console\Commands\SetupCommand;

class FeedbackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerObservers();
        $this->registerViewComposers();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register Feedback's console commands.
     *
     * @return void
     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SetupCommand::class,
            ]);
        }
    }

    /**
     * Setup the resource publishing groups for Feedback.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../public' => public_path(),
        ], 'public');

        $this->publishes([
            __DIR__.'/../../config/feedback.php' => config_path('feedback.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateFeedbackTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_feedback_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_feedback_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Register Feedback's routes.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Register Feedback's views.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.feedback');
    }

    /**
     * Register Feedback's observers.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        FeedbackModel::observe(FeedbackObserver::class);
    }

    /**
     * Register Feedback's view composers.
     *
     * @return void
     */
    public function registerViewComposers(): void
    {
        view()->composer('admin.module.feedback::includes.navigation', function($view) {
            $view->with('unreadBadge', FeedbackModel::unread()->count());
        });
    }
}
