<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Providers\AppsProvider;

use function app;
use function assert;
use function config_path;
use function database_path;

class ServiceProvider extends LaravelServiceProvider
{
    public function register(): void
    {
        $appsProvider = app(AppsProvider::class);
        assert($appsProvider instanceof AppsProvider);

        $appsProvider->registerConfig();

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(AppsProvider::COMMANDS);
    }

    public function boot(): void
    {
        if (! app()->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/' . UserStatusConfigInterface::CONFIG_NAME . '.php' => config_path(UserStatusConfigInterface::CONFIG_NAME . '.php'),
        ], 'thebachtiarz-userstatus-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'thebachtiarz-userstatus-migrations');
    }
}
