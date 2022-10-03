<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface UserModelInterface
{
    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

    // ? Setter Modules
    /**
     * Set id
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void;
}
