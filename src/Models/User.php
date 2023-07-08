<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models;

use TheBachtiarz\Auth\Models\AuthUser as TheBachtiarzAuthUserModel;
use TheBachtiarz\UserStatus\Interfaces\Model\UserInterface;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusRelationTrait;

class User extends TheBachtiarzAuthUserModel implements UserInterface
{
    use UserStatusRelationTrait;
}
