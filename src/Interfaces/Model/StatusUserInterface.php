<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Interfaces\Model;

use TheBachtiarz\Base\App\Interfaces\Model\AbstractModelInterface;

interface StatusUserInterface extends AbstractModelInterface
{
    /**
     * Table name
     */
    public const TABLE_NAME = 'status_users';

    /**
     * Model attributes
     */
    public const ATTRIBUTES_FILLABLE = [
        self::ATTRIBUTE_NAME,
        self::ATTRIBUTE_CODE,
        self::ATTRIBUTE_ABILITIES,
    ];

    public const ATTRIBUTE_NAME      = 'name';
    public const ATTRIBUTE_CODE      = 'code';
    public const ATTRIBUTE_ABILITIES = 'abilities';

    // ? Getter Modules

    /**
     * Get name
     */
    public function getName(): string|null;

    /**
     * Get code
     */
    public function getCode(): string|null;

    /**
     * Get id
     */
    public function getAbilities(): string|null;

    // ? Setter Modules

    /**
     * Set name
     */
    public function setName(string $name): self;

    /**
     * Set code
     */
    public function setCode(string $code): self;

    /**
     * Set abilities
     */
    public function setAbilities(string $abilities): self;
}
