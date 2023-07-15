<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models\Object\Entity;

class StatusUserAbilityEntity
{
    /**
     * Constructor
     */
    public function __construct(
        protected string|null $abilityName = null,
        protected array|null $abilityValue = null,
    ) {
    }

    // ? Public Methods

    /**
     * Return entity to array type
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->getAbilityName() => $this->getAbilityValue(),
        ];
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    /**
     * Get ability name
     */
    public function getAbilityName(): string|null
    {
        return $this->abilityName;
    }

    /**
     * Get ability value
     */
    public function getAbilityValue(): array|null
    {
        return $this->abilityValue ?? ['*'];
    }

    // ? Setter Modules

    /**
     * Set ability name
     */
    public function setAbilityName(string|null $abilityName): self
    {
        $this->abilityName = $abilityName;

        return $this;
    }

    /**
     * Set ability value
     */
    public function setAbilityValue(array|null $abilityValue): self
    {
        $this->abilityValue = $abilityValue;

        return $this;
    }
}
