<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use TheBachtiarz\Base\AppConfigInterface;

use function tbbaseconfig;
use function tbstatususerrestapipath;

class StatusRouteServiceProvider extends RouteServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        Route::prefix(tbbaseconfig(
            keyName: AppConfigInterface::CONFIG_APP_PREFIX,
            useOrigin: false,
        ))->group(tbstatususerrestapipath());
    }
}
