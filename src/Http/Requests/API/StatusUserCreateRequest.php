<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\API;

use TheBachtiarz\Base\App\Http\Requests\AbstractRequest;
use TheBachtiarz\UserStatus\Http\Requests\Rules\StatusUserCreateRule;

class StatusUserCreateRequest extends AbstractRequest
{
    public function rules(): array
    {
        return StatusUserCreateRule::rules();
    }

    public function messages()
    {
        return StatusUserCreateRule::messages();
    }
}
