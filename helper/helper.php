<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;
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

        if (! $statusUserCode || mb_strlen($statusUserCode) < 1) {
            $statusUserCode   = tbuserstatusconfig(UserStatusConfigInterface::DEFAULT_STATUS_CODE, false);
            $useDefaultStatus = true;
        }

        PROCESS_GET:
        $statusUserEntity = StatusUser::getByCode($statusUserCode)->first();

        if ($useDefaultStatus && ! $statusUserEntity) {
            Artisan::call('thebachtiarz:userstatus:generate:default');
            goto PROCESS_GET;
        }

        return $statusUserRepo->getByCode($statusUserCode);
    }
}
