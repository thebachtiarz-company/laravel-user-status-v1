<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Helpers;

use TheBachtiarz\Base\App\Helpers\StringHelper;
use TheBachtiarz\UserStatus\Models\StatusUser;

class StatusUserHelper
{
    // ? Public Methods

    /**
     * Generate new code
     */
    public function generateNewCode(int $codeLength = 7): string
    {
        $randomString = '';

        do {
            $randomString = StringHelper::shuffleBoth($codeLength);
        } while (! ! StatusUser::getByCode($randomString)->first());

        return $randomString;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
