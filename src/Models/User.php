<?php

namespace TheBachtiarz\UserStatus\Models;

use TheBachtiarz\Auth\Model\User as TheBachtiarzAuthUserModel;
use TheBachtiarz\UserStatus\Interfaces\Model\UserModelInterface;
use TheBachtiarz\UserStatus\Traits\Models\UserStatusRelationTrait;

class User extends TheBachtiarzAuthUserModel implements UserModelInterface
{
    use UserStatusRelationTrait;

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(UserModelInterface::USER_ATTRIBUTE_ID);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): void
    {
        $this->__set(UserModelInterface::USER_ATTRIBUTE_ID, $id);
    }
}
