<?php

declare(strict_types=1);

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
     */
    public function scopeGetByCode(Builder $builder, string $statusCode): Builder
    {
        $attribute = StatusUserInterface::ATTRIBUTE_CODE;

        return $builder->where(DB::raw("BINARY `$attribute`"), $statusCode);
    }

    /**
     * Get by codes
     */
    public function scopeGetByCodes(Builder $builder, array $statusCodes): Builder
    {
        $attribute = StatusUserInterface::ATTRIBUTE_CODE;

        return $builder->whereIn(DB::raw("BINARY `$attribute`"), $statusCodes);
    }
}
