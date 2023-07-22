<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Requests\Rules;

use TheBachtiarz\Base\App\Http\Requests\Rules\AbstractRule;

use function sprintf;

class StatusUserCreateRule extends AbstractRule
{
    public const INPUT_CODE      = 'code';
    public const INPUT_NAME      = 'name';
    public const INPUT_ABILITIES = 'abilities';

    public static function rules(): array
    {
        return [
            self::INPUT_CODE => [
                'nullable',
                'alpha_num',
            ],
            self::INPUT_NAME => [
                'required',
                'string',
            ],
            self::INPUT_ABILITIES => [
                'required',
                'json',
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            sprintf('%s.*', self::INPUT_CODE) => 'Status user code format invalid',

            sprintf('%s.required', self::INPUT_NAME) => 'Status user name is required',
            sprintf('%s.*', self::INPUT_NAME) => 'Status user name format invalid',

            sprintf('%s.required', self::INPUT_ABILITIES) => 'Status user ability is required',
            sprintf('%s.json', self::INPUT_ABILITIES) => 'Status user ability should be JSON format',
            sprintf('%s.*', self::INPUT_ABILITIES) => 'Status user ability format invalid',
        ];
    }
}
