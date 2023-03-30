<?php

use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;

if (!function_exists('tbuserstatusconfig')) {
    /**
     * TheBachtiarz user status config
     *
     * @param string|null $keyName config key name | null will return all
     * @return mixed
     */
    function tbuserstatusconfig(?string $keyName = null): mixed
    {
        $configName = UserStatusConfigInterface::CONFIG_NAME;

        return iconv_strlen($keyName)
            ? config("{$configName}.{$keyName}")
            : config("{$configName}");
    }
}
