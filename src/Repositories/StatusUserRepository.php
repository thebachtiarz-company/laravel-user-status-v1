<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;
use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;

use function app;
use function assert;

class StatusUserRepository extends AbstractRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modelEntity = app(StatusUser::class);

        parent::__construct();
    }

    // ? Public Methods

    /**
     * Get status by code
     */
    public function getByCode(string $code): StatusUserInterface|null
    {
        $this->modelBuilder(modelBuilder: StatusUser::getByCode($code));

        $statusUser = $this->modelBuilder()->first();

        if (! $statusUser && $this->throwIfNullEntity()) {
            throw new ModelNotFoundException("Status with code '$code' not found");
        }

        return $statusUser;
    }

    /**
     * Create new status
     */
    public function create(StatusUserInterface $statusUserInterface): StatusUserInterface
    {
        $create = $this->createFromModel($statusUserInterface);
        assert($create instanceof StatusUserInterface);

        if (! $create) {
            throw new ModelNotFoundException('Failed to create new status');
        }

        return $create;
    }

    /**
     * Update current status
     */
    public function save(StatusUserInterface $statusUserInterface): StatusUSerInterface
    {
        /** @var Model|StatusUserInterface $statusUserInterface */
        $save = $statusUserInterface->save();

        if (! $save) {
            throw new ModelNotFoundException('Failed to save current status');
        }

        return $statusUserInterface;
    }

    /**
     * Delete status by code
     */
    public function deleteByCode(string $code): bool
    {
        $statusUser = $this->getByCode($code);

        if (! $statusUser) {
            throw new ModelNotFoundException('Failed to delete status');
        }

        return $this->deleteById($statusUser->getId());
    }

    // ? Protected Methods

    protected function getByIdErrorMessage(): string|null
    {
        return "Status with id '%s' not found!";
    }

    protected function createOrUpdateErrorMessage(): string|null
    {
        return 'Failed to %s status';
    }

    // ? Private Methods

    // ? Setter Modules
}
