<?php

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\UserStatus\Interfaces\Model\UserModelInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusModelInterface;
use TheBachtiarz\UserStatus\Traits\Models\UserStatusScopeTrait;

class UserStatus extends Model implements UserStatusModelInterface
{
    use UserStatusScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = UserStatusModelInterface::USER_STATUS_ATTRIBUTES;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId(): ?int
    {
        return $this->__get(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_USERID);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusUserId(): ?int
    {
        return $this->__get(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_STATUSUSERID);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): void
    {
        $this->__set(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_ID, $id);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserId(int $userId): void
    {
        $this->__set(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_USERID, $userId);
    }

    /**
     * {@inheritDoc}
     */
    public function setStatusUserId(int $statusUserId): void
    {
        $this->__set(UserStatusModelInterface::USER_STATUS_ATTRIBUTE_STATUSUSERID, $statusUserId);
    }

    // ? Relations
    /**
     * Relation user belongs to
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, UserStatusModelInterface::USER_STATUS_ATTRIBUTE_USERID);
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
            UserStatusModelInterface::USER_STATUS_ATTRIBUTE_STATUSUSERID,
            UserModelInterface::USER_ATTRIBUTE_ID
        );
    }
}
