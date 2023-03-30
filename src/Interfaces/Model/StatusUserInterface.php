<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model;

interface StatusUserInterface
{
    /**
     * Model attributes
     *
     * @var array
     */
    public const ATTRIBUTES_FILLABLE = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_CODE,
        self::ATTRIBUTE_ABILITIES
    ];

    public const ATTRIBUTE_ID = 'id';
    public const ATTRIBUTE_NAME = 'name';
    public const ATTRIBUTE_CODE = 'code';
    public const ATTRIBUTE_ABILITIES = 'abilities';

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
     * @return self
     */
    public function setId(int $id): self;

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;

    /**
     * Set code
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self;

    /**
     * Set abilities
     *
     * @param string $abilities
     * @return self
     */
    public function setAbilities(string $abilities): self;
}
