<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Models\AbstractAuthUser;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;
use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Models\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

use function app;
use function assert;

class UserStatusRepository extends AbstractRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modelEntity = app(UserStatus::class);

        parent::__construct();
    }

    // ? Public Methods

    /**
     * Get user status by user
     */
    public function getByUser(AbstractAuthUser $abstractAuthUser): UserStatusInterface|null
    {
        $this->modelBuilder(modelBuilder: UserStatus::getByUser($abstractAuthUser));

        $userStatus = $this->modelBuilder()->first();

        if (! $userStatus && $this->throwIfNullEntity()) {
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
        $this->modelBuilder(modelBuilder: UserStatus::getByStatusUser($statusUserInterface));

        if (! $this->modelBuilder()->count() && $this->throwIfNullEntity()) {
            throw new ModelNotFoundException('Cannot find user status for current status');
        }

        return $this->modelBuilder()->get();
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
        assert($userStatus instanceof Model || $userStatus === null);

        if (! $userStatus) {
            throw new ModelNotFoundException('Failed to delete user status');
        }

        return $userStatus->delete();
    }

    // ? Protected Methods

    protected function getByIdErrorMessage(): string|null
    {
        return "User status with id '%s' not found!";
    }

    protected function createOrUpdateErrorMessage(): string|null
    {
        return 'Failed to %s user status';
    }

    // ? Private Methods

    // ? Setter Modules
}
