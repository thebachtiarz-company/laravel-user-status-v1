<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface UserStatusInterface
{
    /**
     * Model attributes
     *
     * @var array
     */
    public const ATTRIBUTES_FILLABLE = [
        self::ATTRIBUTE_USERID,
        self::ATTRIBUTE_STATUSUSERID
    ];

    public const ATTRIBUTE_ID = 'id';
    public const ATTRIBUTE_USERID = 'user_id';
    public const ATTRIBUTE_STATUSUSERID = 'status_user_id';

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
