<?php

namespace TheBachtiarz\UserStatus\Models;

use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\User as TheBachtiarzAuthUserModel;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusRelationTrait;

class User extends TheBachtiarzAuthUserModel implements UserInterface
{
    use UserStatusRelationTrait;
}
