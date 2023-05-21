<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

use TheBachtiarz\Base\App\Interfaces\Model\AbstractModelInterface;

interface UserStatusInterface extends AbstractModelInterface
{
    /**
     * Table name
     *
     * @var string
     */
    public const TABLE_NAME = 'user_statuses';

    /**
     * Model attributes
     *
     * @var array
     */
    public const ATTRIBUTES_FILLABLE = [
        self::ATTRIBUTE_USERID,
        self::ATTRIBUTE_STATUSUSERID
    ];

    public const ATTRIBUTE_USERID = 'user_id';
    public const ATTRIBUTE_STATUSUSERID = 'status_user_id';

    // ? Getter Modules
    /**
     * Get user id
     *
     * @return integer|null
     */
    public function getUserId(): ?int;

    /**
     * Get status user id
     *
     * @return integer|null
     */
    public function getStatusUserId(): ?int;

    // ? Setter Modules
    /**
     * Set user id
     *
     * @param integer $userId
     * @return self
     */
    public function setUserId(int $userId): self;

    /**
     * Set status user id
     *
     * @param integer $statusUserId
     * @return self
     */
    public function setStatusUserId(int $statusUserId): self;
}
