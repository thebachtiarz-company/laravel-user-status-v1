<?php

namespace TheBachtiarz\UserStatus\Traits\Models;

use Illuminate\Database\Eloquent\Builder;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserModelInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserModelInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusModelInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;
use TheBachtiarz\UserStatus\Models\User;

/**
 * User Status Scope Trait
 */
trait UserStatusScopeTrait
{
    //

    /**
     * Get by user
     *
     * @param Builder $builder
     * @param User $user
     * @return Builder
     */
    public function scopeGetByUser(Builder $builder, User $user): Builder
    {
        return $builder->where(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_USERID, $user->__get(UserModelInterface::USER_ATTRIBUTE_ID));
    }

    /**
     * Get by status user
     *
     * @param Builder $builder
     * @param StatusUser $statusUser
     * @return Builder
     */
    public function scopeGetByStatusUser(Builder $builder, StatusUser $statusUser): Builder
    {
        return $builder->where(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_STATUSUSERID, $statusUser->__get(StatusUserModelInterface::STATUS_USER_ATTRIBUTE_ID));
    }

    /**
     * Get by status codes
     *
     * @param Builder $builder
     * @param array $statusCodes
     * @return Builder
     */
    public function scopeGetByStatusCodes(Builder $builder, array $statusCodes): Builder
    {
        $_statusUsers = StatusUser::getByCodes($statusCodes)->get();

        $_statusUserIds = [];

        foreach ($_statusUsers as $key => $statusUser) {
            $_statusUserIds[] = $statusUser->id;
        }

        return $builder->whereIn(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_STATUSUSERID, $_statusUserIds);
    }
}
