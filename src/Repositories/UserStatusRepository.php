<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Models\AbstractAuthUser;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

use function assert;

class UserStatusRepository extends AbstractRepository
{
    // ? Public Methods

    /**
     * Get user status by user
     */
    public function getByUser(AbstractAuthUser $abstractAuthUser): UserStatusInterface
    {
        $userStatus = UserStatus::getByUser($abstractAuthUser)->first();

        if (! $userStatus) {
            throw new ModelNotFoundException('Cannot find user status for current user');
        }

        return $userStatus;
    }

    /**
     * Get user status(es) by status user
     *
     * @return Collection<UserStatusInterface>
     */
    public function getByStatusUser(StatusUserInterface $statusUserInterface): Collection
    {
        $collection = UserStatus::getByStatusUser($statusUserInterface);

        if (! $collection->count()) {
            throw new ModelNotFoundException('Cannot find user status for current status');
        }

        return $collection->get();
    }

    /**
     * Create new user status
     */
    public function create(UserStatusInterface $userStatusInterface): UserStatusInterface
    {
        /** @var Model $userStatusInterface */
        $create = $this->createFromModel($userStatusInterface);
        assert($create instanceof UserStatusInterface);

        if (! $create) {
            throw new ModelNotFoundException('Failed to create new user status');
        }

        return $create;
    }

    /**
     * Update current user status
     */
    public function save(UserStatusInterface $userStatusInterface): UserStatusInterface
    {
        /** @var Model|UserStatusInterface $userStatusInterface */
        $save = $userStatusInterface->save();

        if (! $save) {
            throw new ModelNotFoundException('Failed to save current user status');
        }

        return $userStatusInterface;
    }

    /**
     * Delete user status by user
     */
    public function deleteByUser(AbstractAuthUser $abstractAuthUser): bool
    {
        $userStatus = $this->getByUser($abstractAuthUser);
        assert($userStatus instanceof Model);

        return $userStatus->delete();
    }

    // ? Private Methods

    // ? Setter Modules
}
