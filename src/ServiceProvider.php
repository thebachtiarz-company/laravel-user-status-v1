<?php

namespace TheBachtiarz\UserStatus;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    //

    /**
     * Applications Provider
     *
     * @var AppsProvider
     */
    protected AppsProvider $appsProvider;

    /**
     * Constructor
     *
     * @param Application $application
     * @param AppsProvider $appsProvider
     */
    public function __construct(
        Application $application,
        AppsProvider $appsProvider
    ) {
        parent::__construct($application);
        $this->appsProvider = $appsProvider;
    }

    public function register(): void
    {
        $this->appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($this->appsProvider->registerCommands());
        }
    }

    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . UserStatusConfigInterface::USER_STATUS_CONFIG_NAME . '.php' => config_path(UserStatusConfigInterface::USER_STATUS_CONFIG_NAME . '.php'),
            ], 'thebachtiarz-userstatus-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-userstatus-migrations');
        }
    }
}
