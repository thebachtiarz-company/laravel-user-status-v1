<?php

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;

class StatusUserRepository extends AbstractRepository
{
    //

    // ? Public Methods
    /**
     * Get status by id
     *
     * @param integer $id
     * @return StatusUserInterface
     */
    public function getById(int $id): StatusUserInterface
    {
        $statusUser = StatusUser::find($id);

        if (!$statusUser) throw new ModelNotFoundException("Status with id '$id' not found");

        return $statusUser;
    }

    /**
     * Get status by code
     *
     * @param string $code
     * @return StatusUserInterface
     */
    public function getByCode(string $code): StatusUserInterface
    {
        $statusUser = StatusUser::getByCode($code)->first();

        if (!$statusUser) throw new ModelNotFoundException("Status with code '$code' not found");

        return $statusUser;
    }

    /**
     * Create new status
     *
     * @param StatusUserInterface $statusUserInterface
     * @return StatusUserInterface
     */
    public function create(StatusUserInterface $statusUserInterface): StatusUserInterface
    {
        /** @var Model $statusUserInterface */
        /** @var StatusUserInterface $create */
        $create = $this->createFromModel($statusUserInterface);

        if (!$create) throw new ModelNotFoundException("Failed to create new status");

        return $create;
    }

    /**
     * Update current status
     *
     * @param StatusUserInterface $statusUserInterface
     * @return StatusUSerInterface
     */
    public function save(StatusUserInterface $statusUserInterface): StatusUSerInterface
    {
        /** @var Model|StatusUserInterface $statusUserInterface */
        $save = $statusUserInterface->save();

        if (!$save) throw new ModelNotFoundException("Failed to save current status");

        return $statusUserInterface;
    }

    /**
     * Delete by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        /** @var Model|StatusUserInterface $statusUser */
        $statusUser = $this->getById($id);

        return $statusUser->delete();
    }

    /**
     * Delete status by code
     *
     * @param string $code
     * @return boolean
     */
    public function deleteByCode(string $code): bool
    {
        $statusUser = $this->getByCode($code);

        return $this->deleteById($statusUser->getId());
    }

    // ? Private Methods

    // ? Setter Modules
}
