<?php

namespace TheBachtiarz\UserStatus\Interfaces\Model\Data;

interface StatusUserDataInterface
{
    //

    /**
     * Available attribute
     */
    public const ATTRIBUTES = [
        self::ATTRIBUTE_CODE,
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_ABILITIES
    ];

    public const ATTRIBUTE_CODE = 'code';
    public const ATTRIBUTE_NAME = 'name';
    public const ATTRIBUTE_ABILITIES = 'abilities';

    // ? Public Modules
    /**
     * Get data
     *
     * @param string|null $attribute Attribute name
     * @return mixed
     */
    public function getData(?string $attribute): mixed;

    /**
     * Set data
     *
     * @param string $attribute
     * @param mixed $value
     * @return self
     */
    public function setData(string $attribute, mixed $value): self;

    // ? Getter Modules
    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * get abylities
     *
     * @return array|null
     */
    public function getAbilities(): ?array;

    // ? Setter Modules
    /**
     * Set code
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self;

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;

    /**
     * Set abilities
     *
     * @param array $ability
     * @return self
     */
    public function setAbilities(array $ability): self;
}
