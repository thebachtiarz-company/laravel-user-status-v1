<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Traits\Models;

use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

use function array_merge;
use function collect;

/**
 * User Status Map Trait
 */
trait UserStatusMapTrait
{
    /**
     * User status simple list map
     *
     * @return array
     */
    public function simpleListMap(array $attributes = []): array
    {
        /** @var UserStatus $this */

        return array_merge(
            $this->user->simpleListMap(),
            [
                'status' => collect($this->statususer->simpleListMap())
                    ->only([
                        StatusUserInterface::ATTRIBUTE_NAME,
                        StatusUserInterface::ATTRIBUTE_ABILITIES,
                    ])
                    ->toArray(),
            ],
        );
    }
}
