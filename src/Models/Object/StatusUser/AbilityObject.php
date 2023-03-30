<?php

namespace TheBachtiarz\UserStatus\Models\Object\StatusUser;

class AbilityObject
{
    //

    // ? Public Methods
    /**
     * Encode ability
     *
     * @param array $ability
     * @return string
     */
    public function encode(array $ability): string
    {
        return json_encode($ability);
    }

    /**
     * Decode ability
     *
     * @param string $ability
     * @return array
     */
    public function decode(string $ability): array
    {
        return json_decode($ability, true);
    }
}
