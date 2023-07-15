<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use TheBachtiarz\Auth\Http\Controllers\UserController as TbAuthUserController;
use TheBachtiarz\Auth\Http\Requests\API\UserCreateRequest;
use TheBachtiarz\Auth\Http\Requests\Rules\IdentifierRule;
use TheBachtiarz\Auth\Http\Requests\Rules\PasswordRule;
use TheBachtiarz\Auth\Services\AuthUserService;
use TheBachtiarz\UserStatus\Http\Requests\Rules\StatusUserCodeRule;
use TheBachtiarz\UserStatus\Http\Requests\Rules\UserCreateRule;
use TheBachtiarz\UserStatus\Services\UserService;

class UserController extends TbAuthUserController
{
    /**
     * Constructor
     */
    public function __construct(
        protected AuthUserService $authUserService,
        protected UserService $userService,
    ) {
        parent::__construct(
            authUserService: $authUserService,
        );
    }

    // ? Public Methods

    /**
     * {@inheritDoc}
     *
     * Create user status after user successfully created.
     */
    public function createUser(UserCreateRequest $request): JsonResponse
    {
        $validate = Validator::make(
            data: $request->all(),
            rules: UserCreateRule::rules(),
            messages: UserCreateRule::messages(),
        );

        if ($validate->fails()) {
            throw new ValidationException($validate);
        }

        $this->userService
            ->setStatusUserCode(
                statusUserCode: $request->get(key: StatusUserCodeRule::INPUT_STATUSUSERCODE),
            )
            ->createNewUser(
                identifier: $request->get(key: IdentifierRule::INPUT_IDENTIFIER),
                password: $request->get(key: PasswordRule::INPUT_PASSWORD),
            );

        return $this->getResult();
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
