<?php

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusModelInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;
use TheBachtiarz\UserStatus\Models\User;
use TheBachtiarz\UserStatus\Models\UserStatus;

class UserStatusRepository
{
    //

    // ? Public Methods
    /**
     * Get user status by user
     *
     * @param User $user
     * @return UserStatus
     */
    public function getByUser(User $user): UserStatus
    {
        $_userStatus = UserStatus::getByUser($user)->first();

        if (!$_userStatus) throw new ModelNotFoundException("Cannot find user status for current user");

        return $_userStatus;
    }

    /**
     * Get user status(es) by status user
     *
     * @param StatusUser $statusUser
     * @return Collection<UserStatus>
     */
    public function getByStatusUser(StatusUser $statusUser): Collection
    {
        $_collection = UserStatus::getByStatusUser($statusUser);

        if (!$_collection->count()) throw new ModelNotFoundException("Cannot find user status for current status");

        return $_collection->get();
    }

    /**
     * Create new user status
     *
     * @param UserStatus $userStatus
     * @return UserStatus
     */
    public function create(UserStatus $userStatus): UserStatus
    {
        $_data = [];

        foreach (UserStatusModelInterface::USER_STATUS_ATTRIBUTES_FILLABLE as $key => $attribute) {
            $_data[$attribute] = $userStatus->__get($attribute);
        }

        $_create = UserStatus::create($_data);

        if (!$_create) throw new ModelNotFoundException("Failed to create new user status");

        return $_create;
    }

    /**
     * Update current user status
     *
     * @param UserStatus $userStatus
     * @return UserStatus
     */
    public function save(UserStatus $userStatus): UserStatus
    {
        $_userStatus = $userStatus->save();

        if (!$_userStatus) throw new ModelNotFoundException("Failed to save current user status");

        return $userStatus;
    }

    /**
     * Delete user status by user
     *
     * @param User $user
     * @return boolean
     */
    public function deleteByUser(User $user): bool
    {
        $_userStatus = $this->getByUser($user);

        $_delete = $_userStatus->delete();

        if (!$_delete) throw new ModelNotFoundException("Failed to delete user status in this user");

        return $_delete;
    }

    // ? Private Methods

    // ? Setter Modules
}
