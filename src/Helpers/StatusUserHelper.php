<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Helpers;

use Illuminate\Support\Str;
use TheBachtiarz\UserStatus\Models\StatusUser;

class StatusUserHelper
{
    // ? Public Methods

    /**
     * Generate new code
     */
    public function generateNewCode(): string
    {
        $randomString = '';

        do {
            $randomString = Str::random(7);
            $isExist      = StatusUser::getByCode($randomString);
        } while (! $isExist);

        return $randomString;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
