<?php

use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;

if (!function_exists('tbuserstatusconfig')) {
    /**
     * TheBachtiarz user status config
     *
     * @param string|null $keyName Config key name | null will return all
     * @param boolean|null $useOrigin Use original value from config
     * @return mixed
     */
    function tbuserstatusconfig(?string $keyName = null, ?bool $useOrigin = true): mixed
    {
        $configName = UserStatusConfigInterface::CONFIG_NAME;

        return tbconfig($configName, $keyName, $useOrigin);
    }
}
