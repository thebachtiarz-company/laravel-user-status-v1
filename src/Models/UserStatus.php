<?php

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Base\App\Models\AbstractModel;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusMapTrait;
use TheBachtiarz\UserStatus\Traits\Model\UserStatusScopeTrait;

class UserStatus extends AbstractModel implements UserStatusInterface
{
    use UserStatusScopeTrait, UserStatusMapTrait;

    /**
     * {@inheritDoc}
     */
    protected $table = self::TABLE_NAME;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::ATTRIBUTES_FILLABLE;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getUserId(): ?int
    {
        return $this->__get(self::ATTRIBUTE_USERID);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusUserId(): ?int
    {
        return $this->__get(self::ATTRIBUTE_STATUSUSERID);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setUserId(int $userId): self
    {
        $this->__set(self::ATTRIBUTE_USERID, $userId);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setStatusUserId(int $statusUserId): self
    {
        $this->__set(self::ATTRIBUTE_STATUSUSERID, $statusUserId);

        return $this;
    }

    // ? Relations
    /**
     * Relation user belongs to
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::ATTRIBUTE_USERID);
    }

    /**
     * Relation status user belongs to
     *
     * @return BelongsTo
     */
    public function statususer(): BelongsTo
    {
        return $this->belongsTo(
            StatusUser::class,
            self::ATTRIBUTE_STATUSUSERID,
            UserInterface::ATTRIBUTE_ID
        );
    }
}
