<?php

namespace TheBachtiarz\UserStatus\Services;

use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Repositories\UserRepository;
use TheBachtiarz\Base\App\Services\AbstractService;
use TheBachtiarz\UserStatus\Helpers\StatusUserHelper;
use TheBachtiarz\UserStatus\Interfaces\Model\Data\StatusUserDataInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\Object\StatusUser\AbilityObject;
use TheBachtiarz\UserStatus\Models\StatusUser;
use TheBachtiarz\UserStatus\Models\UserStatus;
use TheBachtiarz\UserStatus\Repositories\StatusUserRepository;
use TheBachtiarz\UserStatus\Repositories\UserStatusRepository;

class StatusUserService extends AbstractService
{
    //

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     * @param StatusUserRepository $statusUserRepository
     * @param UserStatusRepository $userStatusRepository
     * @param AbilityObject $abilityObject
     * @param StatusUserHelper $statusUserHelper
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected StatusUserRepository $statusUserRepository,
        protected UserStatusRepository $userStatusRepository,
        protected AbilityObject $abilityObject,
        protected StatusUserHelper $statusUserHelper
    ) {
        $this->userRepository = $userRepository;
        $this->statusUserRepository = $statusUserRepository;
        $this->userStatusRepository = $userStatusRepository;
        $this->abilityObject = $abilityObject;
        $this->statusUserHelper = $statusUserHelper;
    }

    // ? Public Methods
    /**
     * Create or update status user
     *
     * @param StatusUserDataInterface $statusUserDataInterface
     * @param boolean $useProposedCode
     * @return StatusUser|null
     */
    public function createOrUpdate(
        StatusUserDataInterface $statusUserDataInterface,
        bool $useProposedCode = false
    ): ?StatusUser {
        $status = false;
        $result = null;
        $action = '';

        try {
            if ($statusUserDataInterface->getCode()) {
                /** @var StatusUserInterface $statusUser */
                $statusUser = StatusUser::getByCode($statusUserDataInterface->getCode())->first();

                if (!$statusUser) goto CREATE_PROCESS;

                if ($statusUserDataInterface->getName())
                    $statusUser->setName($statusUserDataInterface->getName());

                if ($statusUserDataInterface->getAbilities())
                    $statusUser->setAbilities($this->abilityObject->encode($statusUserDataInterface->getAbilities()));

                $this->statusUserRepository->save($statusUser);
                $action = 'update';

                goto END_PROCESS;
            }

            CREATE_PROCESS:
            if (!$useProposedCode) {
                $statusUserDataInterface->setCode($this->statusUserHelper->generateNewCode());
            }

            if (!$statusUserDataInterface->getCode()) {
                $statusUserDataInterface->setCode($this->statusUserHelper->generateNewCode());
            }

            $statusUserPrepare = (new StatusUser)
                ->setName($statusUserDataInterface->getName())
                ->setCode($statusUserDataInterface->getCode())
                ->setAbilities($this->abilityObject->encode($statusUserDataInterface->getAbilities()));

            $this->statusUserRepository->create($statusUserPrepare);
            $action = 'create';

            END_PROCESS:
            /** @var \TheBachtiarz\UserStatus\Models\StatusUser $result */
            $result = $this->statusUserRepository->getByCode($statusUserDataInterface->getCode());
            $status = true;
        } catch (\Throwable $th) {
            $this->log($th);
        }

        $this->setResponseData(sprintf('%s %s status user', $status ? 'Successfully' : 'Failed to', $action), $result->simpleListMap());

        return $result;
    }

    /**
     * Create user status by user identifier
     *
     * @param string $userIdentifier
     * @param string $statusCode
     * @return UserInterface|null
     */
    public function createUserStatus(string $userIdentifier, string $statusCode): ?UserInterface
    {
        $status = false;
        $result = null;

        try {
            /** @var UserInterface $user */
            $user = $this->userRepository->getByIdentifier($userIdentifier);

            /** @var StatusUserInterface $statusUser */
            $statusUser = $this->statusUserRepository->getByCode($statusCode);

            /** @var UserStatusInterface $userStatusPrepare */
            $userStatusPrepare = (new UserStatus)
                ->setUserId($user->getId())
                ->setStatusUserId($statusUser->getId());

            $this->userStatusRepository->create($userStatusPrepare);

            $result = $user;
        } catch (\Throwable $th) {
            $this->log($th);
        }

        $this->setResponseData(sprintf('%s create user status', $status ? 'Successfully' : 'Failed to'));

        return $result;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
