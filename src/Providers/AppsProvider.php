<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Providers;

use TheBachtiarz\UserStatus\Console\Commands\GenerateDefaultStatusCommand;

use function app;
use function assert;
use function config;

class AppsProvider
{
    public const COMMANDS = [
        GenerateDefaultStatusCommand::class,
        // todo: daily reset user status abilities
    ];

    /**
     * Register config
     */
    public function registerConfig(): void
    {
        $dataProvider = app(DataProvider::class);
        assert($dataProvider instanceof DataProvider);

        foreach ($dataProvider->registerConfig() as $key => $register) {
            config($register);
        }
    }
}
