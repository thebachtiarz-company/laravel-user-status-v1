<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Interfaces\Models;

use TheBachtiarz\Base\App\Interfaces\Models\AbstractModelInterface;

interface UserStatusInterface extends AbstractModelInterface
{
    /**
     * Table name
     */
    public const TABLE_NAME = 'user_statuses';

    /**
     * Model attributes
     */
    public const ATTRIBUTE_FILLABLE = [
        self::ATTRIBUTE_USERID,
        self::ATTRIBUTE_STATUSUSERID,
    ];

    public const ATTRIBUTE_USERID       = 'auth_user_id';
    public const ATTRIBUTE_STATUSUSERID = 'status_user_id';

    // ? Getter Modules

    /**
     * Get user id
     */
    public function getUserId(): int|null;

    /**
     * Get status user id
     */
    public function getStatusUserId(): int|null;

    // ? Setter Modules

    /**
     * Set user id
     */
    public function setUserId(int $userId): self;

    /**
     * Set status user id
     */
    public function setStatusUserId(int $statusUserId): self;
}
