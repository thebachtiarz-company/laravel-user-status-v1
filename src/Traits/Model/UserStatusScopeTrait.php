<?php

namespace TheBachtiarz\UserStatus\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;

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
     * @param UserInterface $userInterface
     * @return Builder
     */
    public function scopeGetByUser(Builder $builder, UserInterface $userInterface): Builder
    {
        return $builder->where(UserStatusInterface::ATTRIBUTE_USERID, $userInterface->getId());
    }

    /**
     * Get by status user
     *
     * @param Builder $builder
     * @param StatusUserInterface $statusUserInterface
     * @return Builder
     */
    public function scopeGetByStatusUser(Builder $builder, StatusUserInterface $statusUserInterface): Builder
    {
        return $builder->where(UserStatusInterface::ATTRIBUTE_STATUSUSERID, $statusUserInterface->getId());
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

        return $builder->whereIn(UserStatusInterface::ATTRIBUTE_STATUSUSERID, $_statusUserIds);
    }
}
