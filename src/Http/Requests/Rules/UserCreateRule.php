<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\Rules;

use TheBachtiarz\Auth\Http\Requests\Rules\UserCreateRule as AuthUserCreateRule;

use function array_merge;

class UserCreateRule extends AuthUserCreateRule
{
    public static function rules(): array
    {
        return array_merge(
            parent::rules(),
            StatusUserCodeRule::rules(),
        );
    }

    public static function messages(): array
    {
        return array_merge(
            parent::messages(),
            StatusUserCodeRule::messages(),
        );
    }
}
