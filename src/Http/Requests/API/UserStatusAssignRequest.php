<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\API;

use TheBachtiarz\Base\App\Http\Requests\AbstractRequest;
use TheBachtiarz\UserStatus\Http\Requests\Rules\UserStatusAssignRule;

class UserStatusAssignRequest extends AbstractRequest
{
    public function rules(): array
    {
        return UserStatusAssignRule::rules();
    }

    public function messages()
    {
        return UserStatusAssignRule::messages();
    }
}
