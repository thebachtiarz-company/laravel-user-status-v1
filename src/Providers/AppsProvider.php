<?php

namespace TheBachtiarz\UserStatus\Providers;

class AppsProvider
{
    //

    public const COMMANDS = [
        \TheBachtiarz\UserStatus\Console\Commands\GenerateDefaultStatusCommand::class
        // todo: daily reset user status abilities
    ];

    /**
     * Register config
     *
     * @return void
     */
    public function registerConfig(): void
    {
        $container = \Illuminate\Container\Container::getInstance();

        /** @var DataProvider $_dataProvider */
        $_dataProvider = $container->make(DataProvider::class);

        foreach ($_dataProvider->registerConfig() as $key => $register)
            config($register);
    }
}
