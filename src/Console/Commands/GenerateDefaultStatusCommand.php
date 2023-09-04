<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Console\Commands;

use TheBachtiarz\Base\App\Console\Commands\AbstractCommand;
use TheBachtiarz\Base\App\Helpers\TemporaryDataHelper;
use TheBachtiarz\Base\App\Libraries\Log\LogLibrary;
use TheBachtiarz\UserStatus\Interfaces\Configs\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Models\Data\StatusUserData;
use TheBachtiarz\UserStatus\Models\Object\Entity\StatusUserAbilityEntity;
use TheBachtiarz\UserStatus\Services\StatusUserService;

use function tbuserstatusconfig;

class GenerateDefaultStatusCommand extends AbstractCommand
{
    /**
     * Constructor
     */
    public function __construct(
        protected LogLibrary $logLibrary,
        protected StatusUserService $statusUserService,
    ) {
        $this->signature    = 'thebachtiarz:userstatus:generate:default';
        $this->commandTitle = 'Generate Default User Status';
        $this->description  = 'Generate default user status entity.';

        parent::__construct();
    }

    public function commandProcess(): bool
    {
        TemporaryDataHelper::addData(attribute: 'tbusv1_ignore_gate', value: true);

        $statusUserData = (new StatusUserData())
            ->setCode(tbuserstatusconfig(UserStatusConfigInterface::DEFAULT_STATUS_CODE, false))
            ->setName('Guest')
            ->setAbilities((new StatusUserAbilityEntity(abilityName: 'guest'))->toArray());

        $create = $this->statusUserService->createOrUpdate(
            statusUserDataInterface: $statusUserData,
            useProposedCode: true,
        );

        TemporaryDataHelper::forget(key: 'tbusv1_ignore_gate');

        return $create['status'];
    }
}
