<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;

use function assert;

class StatusUserRepository extends AbstractRepository
{
    // ? Public Methods

    /**
     * Get status by id
     */
    public function getById(int $id): StatusUserInterface
    {
        $statusUser = StatusUser::find($id);

        if (! $statusUser) {
            throw new ModelNotFoundException("Status with id '$id' not found");
        }

        return $statusUser;
    }

    /**
     * Get status by code
     */
    public function getByCode(string $code): StatusUserInterface
    {
        $statusUser = StatusUser::getByCode($code)->first();

        if (! $statusUser) {
            throw new ModelNotFoundException("Status with code '$code' not found");
        }

        return $statusUser;
    }

    /**
     * Create new status
     */
    public function create(StatusUserInterface $statusUserInterface): StatusUserInterface
    {
        /** @var Model $statusUserInterface */
        $create = $this->createFromModel($statusUserInterface);
        assert($create instanceof StatusUserInterface);

        if (! $create) {
            throw new ModelNotFoundException('Failed to create new status');
        }

        return $create;
    }

    /**
     * Update current status
     */
    public function save(StatusUserInterface $statusUserInterface): StatusUSerInterface
    {
        /** @var Model|StatusUserInterface $statusUserInterface */
        $save = $statusUserInterface->save();

        if (! $save) {
            throw new ModelNotFoundException('Failed to save current status');
        }

        return $statusUserInterface;
    }

    /**
     * Delete by id
     */
    public function deleteById(int $id): bool
    {
        $statusUser = $this->getById($id);
        assert($statusUser instanceof Model);

        return $statusUser->delete();
    }

    /**
     * Delete status by code
     */
    public function deleteByCode(string $code): bool
    {
        $statusUser = $this->getByCode($code);

        return $this->deleteById($statusUser->getId());
    }

    // ? Private Methods

    // ? Setter Modules
}
