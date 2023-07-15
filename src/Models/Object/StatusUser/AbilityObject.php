<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models\Object\StatusUser;

use function json_decode;
use function json_encode;

class AbilityObject
{
    // ? Public Methods

    /**
     * Encode ability
     *
     * @param array $ability
     */
    public function encode(array $ability): string
    {
        return json_encode(value: $ability);
    }

    /**
     * Decode ability
     *
     * @return array
     */
    public function decode(string $ability): array
    {
        return json_decode(json: $ability, associative: true);
    }
}
