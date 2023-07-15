<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Services;

use TheBachtiarz\Auth\Models\AbstractAuthUser;
use TheBachtiarz\Auth\Repositories\AuthUserRepository;
use TheBachtiarz\Base\App\Services\AbstractService;
use TheBachtiarz\UserStatus\Helpers\StatusUserHelper;
use TheBachtiarz\UserStatus\Interfaces\Model\Data\StatusUserDataInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\Object\StatusUser\AbilityObject;
use TheBachtiarz\UserStatus\Models\StatusUser;
use TheBachtiarz\UserStatus\Models\UserStatus;
use TheBachtiarz\UserStatus\Repositories\StatusUserRepository;
use TheBachtiarz\UserStatus\Repositories\UserStatusRepository;
use Throwable;

use function assert;
use function sprintf;
use function tbstatusauthorizationgate;

class StatusUserService extends AbstractService
{
    /**
     * Constructor
     */
    public function __construct(
        protected AuthUserRepository $authUserRepository,
        protected StatusUserRepository $statusUserRepository,
        protected UserStatusRepository $userStatusRepository,
        protected AbilityObject $abilityObject,
        protected StatusUserHelper $statusUserHelper,
    ) {
    }

    // ? Public Methods

    /**
     * Create or update status user
     *
     * @return array
     */
    public function createOrUpdate(
        StatusUserDataInterface $statusUserDataInterface,
        bool $useProposedCode = false,
    ): array {
        $action = 'create';

        try {
            tbstatusauthorizationgate(allowedActions: ['status-user:create', 'status-user:update']);

            if ($statusUserDataInterface->getCode()) {
                $statusUser = StatusUser::getByCode($statusUserDataInterface->getCode())->first();
                assert($statusUser instanceof StatusUserInterface || $statusUser === null);

                if (! $statusUser) {
                    goto CREATE_PROCESS;
                }

                if ($statusUserDataInterface->getName()) {
                    $statusUser->setName($statusUserDataInterface->getName());
                }

                if ($statusUserDataInterface->getAbilities()) {
                    $statusUser->setAbilities($this->abilityObject->encode($statusUserDataInterface->getAbilities()));
                }

                $this->statusUserRepository->save($statusUser);
                $action = 'update';

                goto END_PROCESS;
            }

            CREATE_PROCESS:
            if (! $useProposedCode || ! $statusUserDataInterface->getCode()) {
                $statusUserDataInterface->setCode($this->statusUserHelper->generateNewCode());
            }

            $statusUserPrepare = (new StatusUser())
                ->setName($statusUserDataInterface->getName())
                ->setCode($statusUserDataInterface->getCode())
                ->setAbilities($this->abilityObject->encode($statusUserDataInterface->getAbilities()));

            $this->statusUserRepository->create($statusUserPrepare);
            $action = 'create';

            END_PROCESS:
            $getProcess = $this->statusUserRepository->getByCode($statusUserDataInterface->getCode());
            assert($getProcess instanceof StatusUser);

            $result = $getProcess->simpleListMap();

            $this->setResponseData(message: sprintf('Successfully %s status user', $action), data: $result, httpCode: 201);

            return $this->serviceResult(
                status: true,
                message: sprintf('Successfully %s status user', $action),
                data: $result,
            );
        } catch (Throwable $th) {
            $this->log($th);
            $this->setResponseData(message: $th->getMessage(), status: 'error', httpCode: 202);

            return $this->serviceResult(message: sprintf('Failed to %s status user', $action));
        }
    }

    /**
     * Create or update user status by user identifier
     *
     * @return array
     */
    public function createOrUpdateUserStatus(string $userIdentifier, string $statusCode): array
    {
        try {
            tbstatusauthorizationgate(allowedActions: ['user-status:create', 'user-status:update']);

            $user = $this->authUserRepository->getByIdentifier($userIdentifier);
            assert($user instanceof UserInterface || $user instanceof AbstractAuthUser);

            $statusUser = $this->statusUserRepository->getByCode($statusCode);
            assert($statusUser instanceof StatusUserInterface);

            $userStatusEntity = UserStatus::getByUser($user)->first();
            assert($userStatusEntity instanceof UserStatusInterface);

            if ($userStatusEntity) {
                $userStatusEntity->setStatusUserId($statusUser->getId());

                $save = $this->userStatusRepository->save($userStatusEntity);
                assert($save instanceof UserStatus);

                $result = $save->simpleListMap();
            } else {
                $userStatusPrepare = (new UserStatus())
                    ->setUserId($user->getId())
                    ->setStatusUserId($statusUser->getId());
                assert($userStatusPrepare instanceof UserStatusInterface);

                $create = $this->userStatusRepository->create($userStatusPrepare);
                assert($create instanceof UserStatus);

                $result = $create->simpleListMap();
            }

            $this->setResponseData(
                message: sprintf('Successfully set user status to %s', $statusUser->getName()),
                data: $result,
                httpCode: 201,
            );

            return $this->serviceResult(
                status: true,
                message: sprintf('Successfully set user status to %s', $statusUser->getName()),
                data: $result,
            );
        } catch (Throwable $th) {
            $this->log($th);
            $this->setResponseData(message: $th->getMessage(), status: 'error', httpCode: 202);

            return $this->serviceResult(message: $th->getMessage());
        }
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
