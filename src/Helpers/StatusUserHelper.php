<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Helpers;

use TheBachtiarz\Base\App\Helpers\StringHelper;
use TheBachtiarz\UserStatus\Models\StatusUser;

use function explode;
use function sprintf;

class StatusUserHelper
{
    // ? Public Methods

    /**
     * Generate new code
     */
    public function generateNewCode(int $codeLength = 12): string
    {
        $randomString = '';

        do {
            $randomString = StringHelper::shuffleBoth($codeLength);
        } while (! ! StatusUser::getByCode($randomString)->first());

        return $randomString;
    }

    /**
     * Implement abilities into array of group
     *
     * @param array $abilities
     *
     * @return array[]
     */
    public function implementAbilitiesToArray(array $abilities): array
    {
        $abilityPool = [];

        foreach ($abilities as $key => $action) {
            $schema = explode(':', $action);

            $abilityPool[$schema[0]][] = $schema[1];
        }

        return $abilityPool;
    }

    /**
     * Implement abilities into array of string
     *
     * @param array $abilities
     *
     * @return array<string>
     */
    public function implementAbilitiesToString(array $abilities): array
    {
        $abilityPool = [];

        foreach ($abilities as $group => $actions) {
            foreach ($actions as $key => $action) {
                $abilityPool[] = sprintf('%s:%s', $group, $action);
            }
        }

        return $abilityPool;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
