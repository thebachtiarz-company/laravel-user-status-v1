<?php

namespace TheBachtiarz\UserStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserModelInterface;

class StatusUser extends Model implements StatusUserModelInterface
{
    use SoftDeletes;

    /**
     * {@inheritDoc}
     */
    protected $fillable = ['name', 'code', 'abilities'];

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
    public function getCode(): ?string
    {
        return $this->__get('code');
    }

    /**
     * {@inheritDoc}
     */
    public function getAbilities(): ?string
    {
        return $this->__get('abilities');
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
    public function setCode(string $code): void
    {
        $this->__set('code', $code);
    }

    /**
     * {@inheritDoc}
     */
    public function setAbilities(string $abilities): void
    {
        $this->__set('abilities', $abilities);
    }

    // ? Relations
    /**
     * Relation user status has many
     *
     * @return HasMany
     */
    public function userstatuses(): HasMany
    {
        return $this->hasMany(UserStatus::class, 'status_user_id');
    }
}
