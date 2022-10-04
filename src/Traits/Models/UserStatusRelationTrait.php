<?php

namespace TheBachtiarz\UserStatus\Traits\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusModelInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

/**
 * User Status Relation Trait
 */
trait UserStatusRelationTrait
{
    //

    // ? Relations
    /**
     * Relation user status has one
     *
     * @return HasOne
     */
    public function userstatus(): HasOne
    {
        return $this->hasOne(UserStatus::class, UserStatusModelInterface::USER_STATUS_ATTRIBUTE_USERID);
    }
}
