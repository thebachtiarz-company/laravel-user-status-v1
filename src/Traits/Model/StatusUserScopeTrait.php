<?php

namespace TheBachtiarz\UserStatus\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;

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
        $_statusCodeAttribute = StatusUserInterface::ATTRIBUTE_CODE;

        return $builder->where(DB::raw("BINARY `$_statusCodeAttribute`"), $statusCode);
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
        $_statusCodeAttribute = StatusUserInterface::ATTRIBUTE_CODE;

        return $builder->whereIn(DB::raw("BINARY `$_statusCodeAttribute`"), $statusCodes);
    }
}
