<?php

namespace InetStudio\Feedback;

use Illuminate\Support\ServiceProvider;
use InetStudio\Feedback\Models\FeedbackModel;
use InetStudio\Feedback\Observers\FeedbackObserver;

class FeedbackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../public' => public_path(),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin.module.feedback');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->publishes([
            __DIR__.'/../config/feedback.php' => config_path('feedback.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateFeedbackTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_feedback_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_feedback_tables.php'),
                ], 'migrations');
            }

            $this->commands([
                Commands\SetupCommand::class,
            ]);
        }

        view()->composer('admin.module.feedback::includes.navigation', function($view) {
            $view->with('unreadBadge', FeedbackModel::unread()->count());
        });

        FeedbackModel::observe(FeedbackObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
