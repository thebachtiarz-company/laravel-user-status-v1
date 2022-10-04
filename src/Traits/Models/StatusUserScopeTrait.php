<?php

namespace TheBachtiarz\UserStatus\Traits\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserModelInterface;

/**
 * Status User Scope Trait
 */
trait StatusUserScopeTrait
{
    /**
     * Get by code
     *
     * @param Builder $builder
     * @param string $statusCode
     * @return Builder
     */
    public function scopeGetByCode(Builder $builder, string $statusCode): Builder
    {
        return $builder->where(DB::raw("BINARY `" . StatusUserModelInterface::STATUS_USER_ATTRIBUTE_CODE . "`"), $statusCode);
    }

    /**
     * Get by codes
     *
     * @param Builder $builder
     * @param array $statusCodes
     * @return Builder
     */
    public function scopeGetByCodes(Builder $builder, array $statusCodes): Builder
    {
        return $builder->whereIn(DB::raw("BINARY `" . StatusUserModelInterface::STATUS_USER_ATTRIBUTE_CODE . "`"), $statusCodes);
    }
}
