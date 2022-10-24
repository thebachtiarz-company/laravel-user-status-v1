<?php

namespace TheBachtiarz\UserStatus\Models;

use TheBachtiarz\Auth\Models\User as TheBachtiarzAuthUserModel;
use TheBachtiarz\UserStatus\Interfaces\Model\UserModelInterface;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusRelationTrait;

class User extends TheBachtiarzAuthUserModel implements UserModelInterface
{
    use UserStatusRelationTrait;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
