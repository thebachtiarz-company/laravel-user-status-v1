<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheBachtiarz\Base\App\Models\AbstractModel;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Traits\Model\StatusUserMapTrait;
use TheBachtiarz\UserStatus\Traits\Model\StatusUserScopeTrait;

class StatusUser extends AbstractModel implements StatusUserInterface
{
    use SoftDeletes;
    use StatusUserScopeTrait;
    use StatusUserMapTrait;

    protected $table = self::TABLE_NAME;

    protected $fillable = self::ATTRIBUTES_FILLABLE;

    public function getName(): string|null
    {
        return $this->__get(self::ATTRIBUTE_NAME);
    }

    public function getCode(): string|null
    {
        return $this->__get(self::ATTRIBUTE_CODE);
    }

    public function getAbilities(): string|null
    {
        return $this->__get(self::ATTRIBUTE_ABILITIES);
    }

    public function setName(string $name): self
    {
        $this->__set(self::ATTRIBUTE_NAME, $name);

        return $this;
    }

    public function setCode(string $code): self
    {
        $this->__set(self::ATTRIBUTE_CODE, $code);

        return $this;
    }

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
        return $this->hasMany(UserStatus::class, UserStatusInterface::ATTRIBUTE_STATUSUSERID);
    }
}
