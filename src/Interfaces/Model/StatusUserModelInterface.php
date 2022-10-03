<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface StatusUserModelInterface
{
    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Get id
     *
     * @return string|null
     */
    public function getAbilities(): ?string;

    // ? Setter Modules
    /**
     * Set id
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void;

    /**
     * Set code
     *
     * @param string $code
     * @return void
     */
    public function setCode(string $code): void;

    /**
     * Set abilities
     *
     * @param string $abilities
     * @return void
     */
    public function setAbilities(string $abilities): void;
}
