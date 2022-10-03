<?php

// 

use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;

/**
 * TheBachtiarz user status config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed
 */
function tbauthconfig(?string $keyName = null): mixed
{
    $configName = UserStatusConfigInterface::USER_STATUS_CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}
