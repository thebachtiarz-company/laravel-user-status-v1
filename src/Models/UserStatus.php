<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\Base\App\Models\AbstractModel;
use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Models\UserInterface;
use TheBachtiarz\UserStatus\Interfaces\Models\UserStatusInterface;
use TheBachtiarz\UserStatus\Traits\Models\UserStatusMapTrait;
use TheBachtiarz\UserStatus\Traits\Models\UserStatusScopeTrait;

class UserStatus extends AbstractModel implements UserStatusInterface
{
    use UserStatusScopeTrait;
    use UserStatusMapTrait;

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
     * Get user id
     */
    public function getUserId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_USERID);
    }

    /**
     * Get status user id
     */
    public function getStatusUserId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_STATUSUSERID);
    }

    // ? Setter Modules

    /**
     * Set user id
     */
    public function setUserId(int $userId): self
    {
        $this->__set(self::ATTRIBUTE_USERID, $userId);

        return $this;
    }

    /**
     * Set status user id
     */
    public function setStatusUserId(int $statusUserId): self
    {
        $this->__set(self::ATTRIBUTE_STATUSUSERID, $statusUserId);

        return $this;
    }

    // ? Relations

    /**
     * Relation user belongs to
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: self::ATTRIBUTE_USERID,
            ownerKey: UserInterface::ATTRIBUTE_ID,
        );
    }

    /**
     * Relation status user belongs to
     */
    public function statususer(): BelongsTo
    {
        return $this->belongsTo(
            related: StatusUser::class,
            foreignKey: self::ATTRIBUTE_STATUSUSERID,
            ownerKey: StatusUserInterface::ATTRIBUTE_ID,
        );
    }
}
