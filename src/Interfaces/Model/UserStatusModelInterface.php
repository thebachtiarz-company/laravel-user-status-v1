<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface UserStatusModelInterface
{
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
