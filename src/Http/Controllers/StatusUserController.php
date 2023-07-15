<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use TheBachtiarz\Auth\Http\Requests\Rules\IdentifierRule;
use TheBachtiarz\Base\App\Controllers\AbstractController;
use TheBachtiarz\UserStatus\Http\Requests\API\StatusUserCreateRequest;
use TheBachtiarz\UserStatus\Http\Requests\API\UserStatusAssignRequest;
use TheBachtiarz\UserStatus\Http\Requests\Rules\StatusUserCodeRule;
use TheBachtiarz\UserStatus\Http\Requests\Rules\StatusUserCreateRule;
use TheBachtiarz\UserStatus\Interfaces\Model\Data\StatusUserDataInterface;
use TheBachtiarz\UserStatus\Models\Data\StatusUserData;
use TheBachtiarz\UserStatus\Models\Object\Entity\StatusUserAbilityEntity;
use TheBachtiarz\UserStatus\Services\StatusUserService;
use Throwable;

use function app;
use function array_merge;
use function assert;
use function json_decode;
use function mb_strlen;

class StatusUserController extends AbstractController
{
    /**
     * Constructor
     */
    public function __construct(
        protected StatusUserService $statusUserService,
    ) {
        parent::__construct();
    }

    // ? Public Methods

    /**
     * Create or update status user
     */
    public function createOrUpdateStatus(StatusUserCreateRequest $request): JsonResponse
    {
        $statusUserData = app(StatusUserData::class);
        assert($statusUserData instanceof StatusUserDataInterface);

        $isCodeValue = mb_strlen($request->get(key: StatusUserCreateRule::INPUT_CODE) ?? '') ?: null;
        if ($isCodeValue) {
            $statusUserData->setCode(code: $request->get(key: StatusUserCreateRule::INPUT_CODE));
        }

        if ($request->has(key: StatusUserCreateRule::INPUT_NAME)) {
            $statusUserData->setName(name: $request->get(key: StatusUserCreateRule::INPUT_NAME));
        }

        if ($request->has(key: StatusUserCreateRule::INPUT_ABILITIES)) {
            try {
                $abilitiesResult = [];

                foreach (json_decode($request->get(StatusUserCreateRule::INPUT_ABILITIES), true) ?? [] as $key => $value) {
                    $abilitiesResult = array_merge(
                        $abilitiesResult,
                        (new StatusUserAbilityEntity(abilityName: $key, abilityValue: $value))->toArray(),
                    );
                }

                $statusUserData->setAbilities(abilities: $abilitiesResult);
            } catch (Throwable $th) {
                $this->response()::setResponseData(message: $th->getMessage())->setStatus('error')->setHttpCode(202);

                return $this->getResult();
            }
        }

        $this->statusUserService->createOrUpdate(
            statusUserDataInterface: $statusUserData,
            useProposedCode: ! ! $isCodeValue,
        );

        return $this->getResult();
    }

    /**
     * Assign status to user
     */
    public function userStatusAssign(UserStatusAssignRequest $request): JsonResponse
    {
        $this->statusUserService->createOrUpdateUserStatus(
            userIdentifier: $request->get(key: IdentifierRule::INPUT_IDENTIFIER),
            statusCode: $request->get(key: StatusUserCodeRule::INPUT_STATUSUSERCODE),
        );

        return $this->getResult();
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
