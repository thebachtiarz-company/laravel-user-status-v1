<?php

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\UserStatus\Models\StatusUser;

class StatusUserRepository
{
    //

    // ? Public Methods
    /**
     * Get status by id
     *
     * @param integer $id
     * @return StatusUser
     */
    public function getById(int $id): StatusUser
    {
        $_statusUser = StatusUser::find($id);

        if (!$_statusUser) throw new ModelNotFoundException("Status with id '$id' not found");

        return $_statusUser;
    }

    /**
     * Get status by code
     *
     * @param string $code
     * @return StatusUser
     */
    public function getByCode(string $code): StatusUser
    {
        $_statusUser = StatusUser::getByCode($code)->first();

        if (!$_statusUser) throw new ModelNotFoundException("Status with code '$code' not found");

        return $_statusUser;
    }

    /**
     * Create new status
     *
     * @param StatusUser $statusUser
     * @return StatusUser
     */
    public function create(StatusUser $statusUser): StatusUser
    {
        $_data = [];

        foreach ($statusUser->getFillable() as $key => $attribute) {
            $_data[$attribute] = $statusUser->__get($attribute);
        }

        $_create = StatusUser::create($_data);

        if (!$_create) throw new ModelNotFoundException("Failed to create new status");

        return $_create;
    }

    /**
     * Update current status
     *
     * @param StatusUser $statusUser
     * @return StatusUSer
     */
    public function save(StatusUser $statusUser): StatusUSer
    {
        $_statusUser = $statusUser->save();

        if (!$_statusUser) throw new ModelNotFoundException("Failed to save current status");

        return $statusUser;
    }

    /**
     * Delete status by code
     *
     * @param string $code
     * @return boolean
     */
    public function deleteByCode(string $code): bool
    {
        $_statusUser = $this->getByCode($code);

        $_delete = $_statusUser->delete();

        if (!$_delete) throw new ModelNotFoundException("Failed to delete status with code '$code'");

        return $_delete;
    }

    // ? Private Methods

    // ? Setter Modules
}
