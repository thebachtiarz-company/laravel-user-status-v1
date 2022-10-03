<?php

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusModelInterface;

class UserStatus extends Model implements UserStatusModelInterface
{
    /**
     * {@inheritDoc}
     */
    protected $fillable = ['user_id', 'status_user_id'];

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        return $this->__get('id');
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId(): ?int
    {
        return $this->__get('user_id');
    }

    /**
     * {@inheritDoc}
     */
    public function getStatusUserId(): ?int
    {
        return $this->__get('status_user_id');
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setId(int $id): void
    {
        $this->__set('id', $id);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserId(int $userId): void
    {
        $this->__set('user_id', $userId);
    }

    /**
     * {@inheritDoc}
     */
    public function setStatusUserId(int $statusUserId): void
    {
        $this->__set('status_user_id', $statusUserId);
    }

    // ? Relations
    /**
     * Relation user belongs to
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation status user belongs to
     *
     * @return BelongsTo
     */
    public function statususer(): BelongsTo
    {
        return $this->belongsTo(StatusUser::class, 'status_user_id', 'id');
    }
}
