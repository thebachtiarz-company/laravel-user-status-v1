<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheBachtiarz\Base\App\Models\AbstractModel;
use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Models\UserStatusInterface;
use TheBachtiarz\UserStatus\Traits\Models\StatusUserMapTrait;
use TheBachtiarz\UserStatus\Traits\Models\StatusUserScopeTrait;

class StatusUser extends AbstractModel implements StatusUserInterface
{
    use SoftDeletes;
    use StatusUserScopeTrait;
    use StatusUserMapTrait;

    /**
     * Constructor
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(self::TABLE_NAME);
        $this->fillable(self::ATTRIBUTE_FILLABLE);

        parent::__construct($attributes);
    }

    // ? Getter Modules

    /**
     * Get name
     */
    public function getName(): string|null
    {
        return $this->__get(self::ATTRIBUTE_NAME);
    }

    /**
     * Get code
     */
    public function getCode(): string|null
    {
        return $this->__get(self::ATTRIBUTE_CODE);
    }

    /**
     * Get abilities
     */
    public function getAbilities(): string|null
    {
        return $this->__get(self::ATTRIBUTE_ABILITIES);
    }

    // ? Setter Modules

    /**
     * Set name
     */
    public function setName(string $name): self
    {
        $this->__set(self::ATTRIBUTE_NAME, $name);

        return $this;
    }

    /**
     * Set code
     */
    public function setCode(string $code): self
    {
        $this->__set(self::ATTRIBUTE_CODE, $code);

        return $this;
    }

    /**
     * Set abilities
     */
    public function setAbilities(string $abilities): self
    {
        $this->__set(self::ATTRIBUTE_ABILITIES, $abilities);

        return $this;
    }

    // ? Relations

    /**
     * Relation user status has many
     */
    public function userstatuses(): HasMany
    {
        return $this->hasMany(
            related: UserStatus::class,
            foreignKey: UserStatusInterface::ATTRIBUTE_STATUSUSERID,
            localKey: self::ATTRIBUTE_ID,
        );
    }
}
