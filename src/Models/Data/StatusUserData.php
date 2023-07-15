<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models\Data;

use TheBachtiarz\UserStatus\Interfaces\Model\Data\StatusUserDataInterface;

use function in_array;

class StatusUserData implements StatusUserDataInterface
{
    /**
     * Data
     *
     * @var array
     */
    private array $data = [];

    public function getData(string|null $attribute): mixed
    {
        return @$this->data[$attribute] ?? $this->data;
    }

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

    public function getCode(): string|null
    {
        return @$this->data[self::ATTRIBUTE_CODE];
    }

    public function getName(): string|null
    {
        return @$this->data[self::ATTRIBUTE_NAME];
    }

    public function getAbilities(): array|null
    {
        return @$this->data[self::ATTRIBUTE_ABILITIES];
    }

    // ? Setter Modules

    public function setCode(string $code): self
    {
        $this->data[self::ATTRIBUTE_CODE] = $code;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->data[self::ATTRIBUTE_NAME] = $name;

        return $this;
    }

    public function setAbilities(array $abilities): self
    {
        $this->data[self::ATTRIBUTE_ABILITIES] = $abilities;

        return $this;
    }
}
