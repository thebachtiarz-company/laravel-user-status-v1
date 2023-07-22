<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\UserStatus\Interfaces\Configs\UserStatusConfigInterface;
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

        $this->commands(AppsProvider::COMMANDS_OPEN);

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

        $configName  = UserStatusConfigInterface::CONFIG_NAME;
        $publishName = 'thebachtiarz-userstatus';

        $this->publishes([__DIR__ . "/../config/$configName.php" => config_path("$configName.php")], "$publishName-config");
        $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')], "$publishName-migrations");
    }
}
