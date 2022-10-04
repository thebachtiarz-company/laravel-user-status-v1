<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface UserStatusModelInterface
{
    /**
     * Model attributes
     *
     * @var array
     */
    public const USER_STATUS_ATTRIBUTES = [
        self::USER_STATUS_ATTRIBUTE_USERID,
        self::USER_STATUS_ATTRIBUTE_STATUSUSERID
    ];

    public const USER_STATUS_ATTRIBUTE_ID = 'id';
    public const USER_STATUS_ATTRIBUTE_USERID = 'user_id';
    public const USER_STATUS_ATTRIBUTE_STATUSUSERID = 'status_user_id';

    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

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
     * Set id
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void;

    /**
     * Set user id
     *
     * @param integer $userId
     * @return void
     */
    public function setUserId(int $userId): void;

    /**
     * Set status user id
     *
     * @param integer $statusUserId
     * @return void
     */
    public function setStatusUserId(int $statusUserId): void;
}
