<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Traits\Model;

use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\UserStatus;

/**
 * User Status Map Trait
 */
trait UserStatusMapTrait
{
    /**
     * User status simple list map
     *
     * @return array
     */
    public function simpleListMap(): array
    {
        /** @var UserStatus $this */
        return [
            UserStatusInterface::ATTRIBUTE_USERID => $this->getUserId(),
            StatusUserInterface::ATTRIBUTE_NAME => $this->statususer->{StatusUserInterface::ATTRIBUTE_NAME},
        ];
    }
}
