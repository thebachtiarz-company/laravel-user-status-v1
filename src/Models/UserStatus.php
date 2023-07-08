<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\Base\App\Models\AbstractModel;
use TheBachtiarz\UserStatus\Interfaces\Model\UserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusMapTrait;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusScopeTrait;

class UserStatus extends AbstractModel implements UserStatusInterface
{
    use UserStatusScopeTrait;
    use UserStatusMapTrait;

    protected $table = self::TABLE_NAME;

    protected $fillable = self::ATTRIBUTES_FILLABLE;

    public function getUserId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_USERID);
    }

    public function getStatusUserId(): int|null
    {
        return $this->__get(self::ATTRIBUTE_STATUSUSERID);
    }

    public function setUserId(int $userId): self
    {
        $this->__set(self::ATTRIBUTE_USERID, $userId);

        return $this;
    }

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
        return $this->belongsTo(User::class, self::ATTRIBUTE_USERID);
    }

    /**
     * Relation status user belongs to
     */
    public function statususer(): BelongsTo
    {
        return $this->belongsTo(
            StatusUser::class,
            self::ATTRIBUTE_STATUSUSERID,
            UserInterface::ATTRIBUTE_ID,
        );
    }
}
