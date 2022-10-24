<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface UserStatusModelInterface
{
    /**
     * Model attributes
     *
     * @var array
     */
    public const USER_STATUS_ATTRIBUTES_FILLABLE = [
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
     * @return self
     */
    public function setId(int $id): self;

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
