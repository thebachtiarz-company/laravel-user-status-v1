<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface StatusUserModelInterface
{
    /**
     * Model attributes
     *
     * @var array
     */
    public const STATUS_USER_ATTRIBUTES = [
        self::STATUS_USER_ATTRIBUTE_NAME,
        self::STATUS_USER_ATTRIBUTE_CODE,
        self::STATUS_USER_ATTRIBUTE_ABILITIES
    ];

    public const STATUS_USER_ATTRIBUTE_ID = 'id';
    public const STATUS_USER_ATTRIBUTE_NAME = 'name';
    public const STATUS_USER_ATTRIBUTE_CODE = 'code';
    public const STATUS_USER_ATTRIBUTE_ABILITIES = 'abilities';

    // ? Getter Modules
    /**
     * Get id
     *
     * @return integer|null
     */
    public function getId(): ?int;

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string;

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
     * Set name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

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
