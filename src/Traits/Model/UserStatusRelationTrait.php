<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Traits\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

/**
 * User Status Relation Trait.
 * Used in child class where parent is.
 *
 * @see \TheBachtiarz\Auth\Models\User
 */
trait UserStatusRelationTrait
{
    // ? Relations

    /**
     * Relation user status has one
     */
    public function userstatus(): HasOne
    {
        return $this->hasOne(UserStatus::class, UserStatusInterface::ATTRIBUTE_USERID);
    }
}
