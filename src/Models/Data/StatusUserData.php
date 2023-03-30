<?php

namespace TheBachtiarz\UserStatus\Models\Data;

use TheBachtiarz\UserStatus\Interfaces\Model\Data\StatusUserDataInterface;

class StatusUserData implements StatusUserDataInterface
{
    //

    /**
     * Data
     *
     * @var array
     */
    private array $data = [];

    // ? Public Methods
    /**
     * {@inheritDoc}
     */
    public function getData(?string $attribute): mixed
    {
        return @$this->data[$attribute] ?? $this->data;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getCode(): ?string
    {
        return $this->data[self::ATTRIBUTE_CODE];
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {
        return $this->data[self::ATTRIBUTE_NAME];
    }

    /**
     * {@inheritDoc}
     */
    public function getAbilities(): ?array
    {
        return $this->data[self::ATTRIBUTE_ABILITIES];
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): self
    {
        $this->data[self::ATTRIBUTE_CODE] = $code;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): self
    {
        $this->data[self::ATTRIBUTE_NAME] = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAbilities(array $ability): self
    {
        $this->data[self::ATTRIBUTE_ABILITIES] = $ability;

        return $this;
    }
}
