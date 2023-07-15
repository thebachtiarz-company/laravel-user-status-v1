<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Providers;

use TheBachtiarz\Base\BaseConfigInterface;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;

use function array_merge;
use function config;
use function tbbaseconfig;

class DataProvider
{
    /**
     * List of config who need to registered into current project.
     * Perform by auth app module.
     *
     * @return array
     */
    public function registerConfig(): array
    {
        $registerConfig = [];

        // ! Providers
        $_providers       = config('app.providers');
        $registerConfig[] = [
            'app.providers' => array_merge(
                $_providers,
                [StatusRouteServiceProvider::class],
            ),
        ];

        // ! library configs
        $configRegistered = tbbaseconfig(BaseConfigInterface::CONFIG_REGISTERED);
        $registerConfig[] = [
            BaseConfigInterface::CONFIG_NAME . '.' . BaseConfigInterface::CONFIG_REGISTERED => array_merge(
                $configRegistered,
                [UserStatusConfigInterface::CONFIG_NAME],
            ),
        ];

        return $registerConfig;
    }
}
