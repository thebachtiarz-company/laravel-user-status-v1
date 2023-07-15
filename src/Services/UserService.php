<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\Auth\Repositories\AuthUserRepository;
use TheBachtiarz\Auth\Repositories\PersonalAccessTokenRepository;
use TheBachtiarz\Auth\Services\AuthUserService;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use Throwable;

use function sprintf;
use function tbstatususerget;

class UserService extends AuthUserService
{
    /**
     * Status User Code
     */
    protected string|null $statusUserCode = null;

    /**
     * Constructor
     */
    public function __construct(
        protected AuthUserRepository $authUserRepository,
        protected PersonalAccessTokenRepository $personalAccessTokenRepository,
        protected StatusUserService $statusUserService,
    ) {
        parent::__construct(
            authUserRepository: $authUserRepository,
            personalAccessTokenRepository: $personalAccessTokenRepository,
        );
    }

    // ? Public Methods

    /**
     * {@inheritDoc}
     *
     * Assign status user after create user success.
     *
     * @param string $identifier
     * @param string $password
     *
     * @return array
     */
    public function createNewUser(string $identifier, string $password): array
    {
        try {
            DB::beginTransaction();

            $create = parent::createNewUser(identifier: $identifier, password: $password);

            if (! $create['status']) {
                DB::rollBack();

                return $create;
            }

            $createData = $create['data'];

            $assignUserStatus = $this->statusUserService->hideResponseResult()->createOrUpdateUserStatus(
                userIdentifier: $identifier,
                statusCode: $this->getStatusUserCode(),
            );

            if (! $assignUserStatus['status']) {
                throw new Exception(sprintf(
                    "Failed to apply status for user '%s' with code '%s'",
                    $identifier,
                    $this->getStatusUserCode(),
                ));
            }

            DB::commit();

            $createData['status'] = $assignUserStatus['data']['status'][StatusUserInterface::ATTRIBUTE_NAME];

            $this->setResponseData(message: $create['message'] . ' with status user', data: $createData, httpCode: 201);

            return $this->serviceResult(status: true, message: $create['message'] . ' with status user', data: $createData);
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

    /**
     * Get status user code
     */
    public function getStatusUserCode(): string|null
    {
        return $this->statusUserCode ?? tbstatususerget()->getCode();
    }

    // ? Setter Modules

    /**
     * Set status user code
     */
    public function setStatusUserCode(string|null $statusUserCode = null): self
    {
        $this->statusUserCode = tbstatususerget($statusUserCode)->getCode();

        return $this;
    }
}
