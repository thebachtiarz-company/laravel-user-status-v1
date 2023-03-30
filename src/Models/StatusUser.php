<?php

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Traits\Model\StatusUserMapTrait;
use TheBachtiarz\UserStatus\Traits\Model\StatusUserScopeTrait;

class StatusUser extends Model implements StatusUserInterface
{
    use SoftDeletes;

    use StatusUserScopeTrait, StatusUserMapTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::ATTRIBUTES_FILLABLE;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(self::ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): ?string
    {
        return $this->__get(self::ATTRIBUTE_NAME);
    }

    /**
     * {@inheritDoc}
     */
    public function getCode(): ?string
    {
        return $this->__get(self::ATTRIBUTE_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function getAbilities(): ?string
    {
        return $this->__get(self::ATTRIBUTE_ABILITIES);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): self
    {
        $this->__set(self::ATTRIBUTE_ID, $id);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): self
    {
        $this->__set(self::ATTRIBUTE_NAME, $name);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): self
    {
        $this->__set(self::ATTRIBUTE_CODE, $code);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAbilities(string $abilities): self
    {
        $this->__set(self::ATTRIBUTE_ABILITIES, $abilities);

        return $this;
    }

    // ? Relations
    /**
     * Relation user status has many
     *
     * @return HasMany
     */
    public function userstatuses(): HasMany
    {
        return $this->hasMany(UserStatus::class, UserStatusInterface::ATTRIBUTE_STATUSUSERID);
    }
}
