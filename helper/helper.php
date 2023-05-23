<?php

declare(strict_types=1);

use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;

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
