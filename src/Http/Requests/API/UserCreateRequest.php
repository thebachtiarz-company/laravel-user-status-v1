<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\API;

use TheBachtiarz\Auth\Http\Requests\API\UserCreateRequest as AuthUserCreateRequest;
use TheBachtiarz\UserStatus\Http\Requests\Rules\UserCreateRule;

class UserCreateRequest extends AuthUserCreateRequest
{
    public function rules(): array
    {
        return UserCreateRule::rules();
    }

    public function messages()
    {
        return UserCreateRule::messages();
    }
}
