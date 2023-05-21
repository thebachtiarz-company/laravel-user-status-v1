<?php

namespace TheBachtiarz\UserStatus\Services;

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserCreateDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Services\UserService as TbAuthUserService;
use TheBachtiarz\Base\App\Services\AbstractService;
use TheBachtiarz\UserStatus\Interfaces\Config\UserStatusConfigInterface;

class UserService extends AbstractService
{
    //

    /**
     * Constructor
     *
     * @param TbAuthUserService $tbAuthUserService
     * @param StatusUserService $statusUserService
     */
    public function __construct(
        protected TbAuthUserService $tbAuthUserService,
        protected StatusUserService $statusUserService
    ) {
        $this->tbAuthUserService = $tbAuthUserService;
        $this->statusUserService = $statusUserService;
    }

    // ? Public Methods
    /**
     * Create new user with status user role applied
     *
     * @param UserCreateDataInterface $userCreateDataInterface
     * @param string $statusUserCode
     * @return array
     */
    public function createNewUserWithStatus(UserCreateDataInterface $userCreateDataInterface, string $statusUserCode): array
    {
        $result = $this->tbAuthUserService->createNewUser($userCreateDataInterface);

        try {
            $userIdentifier = '';

            switch (tbauthconfig(AuthConfigInterface::IDENTITY_METHOD, false)) {
                case UserInterface::ATTRIBUTE_EMAIL:
                    $userIdentifier = $result[UserInterface::ATTRIBUTE_EMAIL];
                    break;
                case UserInterface::ATTRIBUTE_USERNAME:
                    $userIdentifier = $result[UserInterface::ATTRIBUTE_USERNAME];
                    break;
                default:
                    break;
            }

            $process = $this->statusUserService->hideResponseResult()->createUserStatus($userIdentifier, $statusUserCode);
            if (!$process['status']) throw new \Exception(sprintf("Failed to apply status for user '%s' with code '%s'", $userIdentifier, $statusUserCode));
        } catch (\Throwable $th) {
            $this->log($th);
        }

        return $result;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
