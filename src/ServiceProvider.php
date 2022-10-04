<?php

namespace TheBachtiarz\UserStatus;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    //

    public function register(): void
    {
        /**
         * @var AppsProvider $appsProvider
         */
        $appsProvider = new AppsProvider;

        $appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($appsProvider->registerCommands());
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
