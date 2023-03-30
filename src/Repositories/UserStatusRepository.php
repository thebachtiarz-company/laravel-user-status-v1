<?php

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

class UserStatusRepository extends AbstractRepository
{
    //

    // ? Public Methods
    /**
     * Get user status by user
     *
     * @param UserInterface $userInterface
     * @return UserStatusInterface
     */
    public function getByUser(UserInterface $userInterface): UserStatusInterface
    {
        $userStatus = UserStatus::getByUser($userInterface)->first();

        if (!$userStatus) throw new ModelNotFoundException("Cannot find user status for current user");

        return $userStatus;
    }

    /**
     * Get user status(es) by status user
     *
     * @param StatusUserInterface $statusUserInterface
     * @return Collection<UserStatusInterface>
     */
    public function getByStatusUser(StatusUserInterface $statusUserInterface): Collection
    {
        $collection = UserStatus::getByStatusUser($statusUserInterface);

        if (!$collection->count()) throw new ModelNotFoundException("Cannot find user status for current status");

        return $collection->get();
    }

    /**
     * Create new user status
     *
     * @param UserStatusInterface $userStatusInterface
     * @return UserStatusInterface
     */
    public function create(UserStatusInterface $userStatusInterface): UserStatusInterface
    {
        /** @var Model $userStatusInterface */
        /** @var UserStatusInterface $create */
        $create = $this->createFromModel($userStatusInterface);

        if (!$create) throw new ModelNotFoundException("Failed to create new user status");

        return $create;
    }

    /**
     * Update current user status
     *
     * @param UserStatusInterface $userStatusInterface
     * @return UserStatusInterface
     */
    public function save(UserStatusInterface $userStatusInterface): UserStatusInterface
    {
        /** @var Model|UserStatusInterface $userStatusInterface */
        $save = $userStatusInterface->save();

        if (!$save) throw new ModelNotFoundException("Failed to save current user status");

        return $userStatusInterface;
    }

    /**
     * Delete user status by user
     *
     * @param UserInterface $userInterface
     * @return boolean
     */
    public function deleteByUser(UserInterface $userInterface): bool
    {
        /** @var Model|UserStatusInterface $userStatus */
        $userStatus = $this->getByUser($userInterface);

        return $userStatus->delete();
    }

    // ? Private Methods

    // ? Setter Modules
}
