<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\Rules;

use TheBachtiarz\Base\App\Http\Requests\Rules\AbstractRule;

use function sprintf;

class StatusUserCodeRule extends AbstractRule
{
    public const INPUT_STATUSUSERCODE = 'statusUserCode';

    public static function rules(): array
    {
        return [
            self::INPUT_STATUSUSERCODE => [
                'nullable',
                'alpha_num',
            ],
        ];
    }

    public static function messages(): array
    {
        return [sprintf('%s.*', self::INPUT_STATUSUSERCODE) => 'Status user code format invalid'];
    }
}
