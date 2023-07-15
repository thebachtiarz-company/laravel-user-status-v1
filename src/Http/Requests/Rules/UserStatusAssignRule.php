<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\Rules;

use TheBachtiarz\Auth\Http\Requests\Rules\IdentifierRule;
use TheBachtiarz\Base\App\Http\Requests\Rule\AbstractRule;

use function array_merge;

class UserStatusAssignRule extends AbstractRule
{
    public static function rules(): array
    {
        return array_merge(
            IdentifierRule::rules(),
            StatusUserCodeRule::rules(),
        );
    }

    public static function messages(): array
    {
        return array_merge(
            IdentifierRule::messages(),
            StatusUserCodeRule::messages(),
        );
    }
}
