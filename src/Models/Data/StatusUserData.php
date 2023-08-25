<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models\Data;

use TheBachtiarz\UserStatus\Interfaces\Models\Data\StatusUserDataInterface;

use function in_array;

class StatusUserData implements StatusUserDataInterface
{
    /**
     * Data
     *
     * @var array
     */
    private array $data = [];

    // ? Public Modules

    /**
     * Get data
     *
     * @param string|null $attribute Attribute name
     */
    public function getData(string|null $attribute): mixed
    {
        return @$this->data[$attribute] ?? $this->data;
    }

    /**
     * Set data
     */
    public function setData(string $attribute, mixed $value): self
    {
        if (in_array($attribute, self::ATTRIBUTES)) {
            $this->data[$attribute] = $value;
        }

        return $this;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    /**
     * Get code
     */
    public function getCode(): string|null
    {
        return @$this->data[self::ATTRIBUTE_CODE];
    }

    /**
     * Get name
     */
    public function getName(): string|null
    {
        return @$this->data[self::ATTRIBUTE_NAME];
    }

    /**
     * get abylities
     */
    public function getAbilities(): array|null
    {
        return @$this->data[self::ATTRIBUTE_ABILITIES];
    }

    // ? Setter Modules

    /**
     * Set code
     */
    public function setCode(string $code): self
    {
        $this->data[self::ATTRIBUTE_CODE] = $code;

        return $this;
    }

    /**
     * Set name
     */
    public function setName(string $name): self
    {
        $this->data[self::ATTRIBUTE_NAME] = $name;

        return $this;
    }

    /**
     * Set abilities
     */
    public function setAbilities(array $abilities): self
    {
        $this->data[self::ATTRIBUTE_ABILITIES] = $abilities;

        return $this;
    }
}
