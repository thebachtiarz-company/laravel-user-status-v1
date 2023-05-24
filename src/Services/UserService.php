<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\Data\UserCreateDataInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Services\UserService as TbAuthUserService;
use TheBachtiarz\Base\App\Services\AbstractService;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use Throwable;

use function array_merge;
use function sprintf;
use function tbauthconfig;

class UserService extends AbstractService
{
    /**
     * Constructor
     */
    public function __construct(
        protected TbAuthUserService $tbAuthUserService,
        protected StatusUserService $statusUserService,
    ) {
        $this->tbAuthUserService = $tbAuthUserService;
        $this->statusUserService = $statusUserService;
    }

    // ? Public Methods

    /**
     * Create new user with status user role applied
     *
     * @return array
     */
    public function createNewUserWithStatus(UserCreateDataInterface $userCreateDataInterface, string $statusUserCode): array
    {
        try {
            DB::beginTransaction();

            $result = $this->tbAuthUserService->createNewUser($userCreateDataInterface);

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
            if (! $process['status']) {
                throw new Exception(sprintf("Failed to apply status for user '%s' with code '%s'", $userIdentifier, $statusUserCode));
            }

            $result = array_merge($result, ['status' => $process['data'][StatusUserInterface::ATTRIBUTE_NAME]]);

            DB::commit();

            return $result;
        } catch (Throwable $th) {
            DB::rollBack();
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
