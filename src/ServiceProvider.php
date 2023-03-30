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
        $container = \Illuminate\Container\Container::getInstance();

        /** @var AppsProvider $_appsProvider */
        $_appsProvider = $container->make(AppsProvider::class);

        $_appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands(AppsProvider::COMMANDS);
        }
    }

    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . UserStatusConfigInterface::CONFIG_NAME . '.php' => config_path(UserStatusConfigInterface::CONFIG_NAME . '.php'),
            ], 'thebachtiarz-userstatus-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-userstatus-migrations');
        }
    }
}
