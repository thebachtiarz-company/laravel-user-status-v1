<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use TheBachtiarz\Base\Config\Helpers\ConfigPoolHelper;
use TheBachtiarz\UserStatus\Gates\AuthorizationGate;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Repositories\StatusUserRepository;

if (! function_exists('tbuserstatusconfig')) {
    /**
     * TheBachtiarz user status config
     *
     * @param string|null $keyName   Config key name | null will return all
     * @param bool|null   $useOrigin Use original value from config
     */
    function tbuserstatusconfig(string|null $keyName = null, bool|null $useOrigin = true): mixed
    {
        $configName = UserStatusConfigInterface::CONFIG_NAME;

        return tbconfig($configName, $keyName, $useOrigin);
    }
}

if (! function_exists('tbstatususerget')) {
    /**
     * Get status user entity.
     *
     * Return default if not exist.
     */
    function tbstatususerget(string|null $statusUserCode = null): StatusUserInterface
    {
        $statusUserRepo = app(StatusUserRepository::class);
        assert($statusUserRepo instanceof StatusUserRepository);

        $useDefaultStatus = false;

        PROCESS_CHECKCODE:
        if (! $statusUserCode || mb_strlen(@$statusUserCode ?? '') < 1) {
            $statusUserCode   = tbuserstatusconfig(UserStatusConfigInterface::DEFAULT_STATUS_CODE, false);
            $useDefaultStatus = true;
        }

        $statusUserEntity = null;
        try {
            $statusUserEntity = $statusUserRepo->getByCode($statusUserCode);
        } catch (Throwable) {
        }

        if (! $statusUserEntity) {
            if ($useDefaultStatus && ! $statusUserEntity) {
                Artisan::call('thebachtiarz:userstatus:generate:default');
            }

            $statusUserCode = null;
            goto PROCESS_CHECKCODE;
        }

        return $statusUserEntity;
    }
}

if (! function_exists('tbstatusabilitypooladd')) {
    /**
     * Add status user ability pool
     *
     * @param array $abilities
     *
     * @return array
     */
    function tbstatusabilitypooladd(array $abilities): array
    {
        return ConfigPoolHelper::addConfigPool(
            configPath: sprintf('%s.%s', UserStatusConfigInterface::CONFIG_NAME, 'status_ability_pool'),
            configValue: $abilities,
            collapse: true,
        )->getPool()->toArray();
    }
}

if (! function_exists('tbstatusauthorizationgate')) {
    /**
     * Authorization gate
     *
     * @param array $allowedActions
     * @param array $onlyStatuses
     */
    function tbstatusauthorizationgate(
        array $allowedActions = ['*'],
        array $onlyStatuses = ['*'],
        bool $useTokenAbilities = true,
    ): void {
        AuthorizationGate::execute(
            allowedActions: $allowedActions,
            onlyStatuses: $onlyStatuses,
            useTokenAbilities: $useTokenAbilities,
        );
    }
}

if (! function_exists('tbstatususerrestapipath')) {
    /**
     * Auth rest api path
     */
    function tbstatususerrestapipath(): string
    {
        return base_path('vendor/thebachtiarz-company/laravel-user-status-v1/src/routes/rest.php');
    }
}
