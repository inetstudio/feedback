<?php

namespace InetStudio\Feedback\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use InetStudio\Feedback\Models\FeedbackModel;
use InetStudio\Feedback\Observers\FeedbackObserver;
use InetStudio\Feedback\Console\Commands\SetupCommand;
use InetStudio\Feedback\Services\Front\FeedbackService;
use InetStudio\Feedback\Listeners\AttachUserToFeedbackListener;

/**
 * Class FeedbackServiceProvider.
 */
class FeedbackServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerEvents();
        $this->registerObservers();
        $this->registerViewComposers();
    }

    /**
     * Регистрация привязки в контейнере.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerBindings();
    }

    /**
     * Регистрация команд.
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
     * Регистрация ресурсов.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
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
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.feedback');
    }

    /**
     * Регистрация переводов.
     *
     * @return void
     */
    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'feedback');
    }

    /**
     * Регистрация событий.
     *
     * @return void
     */
    protected function registerEvents(): void
    {
        Event::listen(app()->make('InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract'), AttachUserToFeedbackListener::class);
        Event::listen(app()->make('InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract'), AttachUserToFeedbackListener::class);
    }

    /**
     * Регистрация наблюдателей.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        FeedbackModel::observe(FeedbackObserver::class);
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    public function registerViewComposers(): void
    {
        view()->composer('admin.module.feedback::back.includes.*', function ($view) {
            $view->with('unreadBadge', FeedbackModel::unread()->count());
        });
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    public function registerBindings(): void
    {
        $this->app->bind('FeedbackService', FeedbackService::class);
    }
}
