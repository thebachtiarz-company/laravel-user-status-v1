<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use TheBachtiarz\Auth\Models\AbstractAuthUser;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;

/**
 * User Status Scope Trait
 */
trait UserStatusScopeTrait
{
    /**
     * Get by user
     */
    public function scopeGetByUser(Builder $builder, AbstractAuthUser $abstractAuthUser): Builder
    {
        return $builder->where(UserStatusInterface::ATTRIBUTE_USERID, $abstractAuthUser->getId());
    }

    /**
     * Get by status user
     */
    public function scopeGetByStatusUser(Builder $builder, StatusUserInterface $statusUserInterface): Builder
    {
        return $builder->where(UserStatusInterface::ATTRIBUTE_STATUSUSERID, $statusUserInterface->getId());
    }

    /**
     * Get by status codes
     */
    public function scopeGetByStatusCodes(Builder $builder, array $statusCodes): Builder
    {
        $statusUsers = StatusUser::getByCodes($statusCodes)->get();

        $statusUserIds = [];

        foreach ($statusUsers as $key => $statusUser) {
            $statusUserIds[] = $statusUser->id;
        }

        return $builder->whereIn(UserStatusInterface::ATTRIBUTE_STATUSUSERID, $statusUserIds);
    }
}
