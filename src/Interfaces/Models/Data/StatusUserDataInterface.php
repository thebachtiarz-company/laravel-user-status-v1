<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Interfaces\Models\Data;

interface StatusUserDataInterface
{
    /**
     * Available attribute
     */
    public const ATTRIBUTES = [
        self::ATTRIBUTE_CODE,
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_ABILITIES,
    ];

    public const ATTRIBUTE_CODE      = 'code';
    public const ATTRIBUTE_NAME      = 'name';
    public const ATTRIBUTE_ABILITIES = 'abilities';

    // ? Public Modules

    /**
     * Get data
     *
     * @param string|null $attribute Attribute name
     */
    public function getData(string|null $attribute): mixed;

    /**
     * Set data
     */
    public function setData(string $attribute, mixed $value): self;

    // ? Getter Modules

    /**
     * Get code
     */
    public function getCode(): string|null;

    /**
     * Get name
     */
    public function getName(): string|null;

    /**
     * get abylities
     */
    public function getAbilities(): array|null;

    // ? Setter Modules

    /**
     * Set code
     */
    public function setCode(string $code): self;

    /**
     * Set name
     */
    public function setName(string $name): self;

    /**
     * Set abilities
     */
    public function setAbilities(array $abilities): self;
}
