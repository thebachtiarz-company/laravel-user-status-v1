<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Console\Commands;

use TheBachtiarz\Base\App\Console\Commands\AbstractCommand;
use TheBachtiarz\Base\App\Helpers\TemporaryDataHelper;
use TheBachtiarz\Base\App\Libraries\Log\LogLibrary;
use TheBachtiarz\UserStatus\Interfaces\Configs\UserStatusConfigInterface;
use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\Data\StatusUserData;
use TheBachtiarz\UserStatus\Models\Object\Entity\StatusUserAbilityEntity;
use TheBachtiarz\UserStatus\Services\StatusUserService;

use function mb_strlen;
use function sprintf;
use function tbconfigvalue;
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

        $guestDefaultCode = tbuserstatusconfig(UserStatusConfigInterface::DEFAULT_STATUS_CODE, false);

        $statusUserData = (new StatusUserData())
            ->setCode($guestDefaultCode)
            ->setName('Guest')
            ->setAbilities((new StatusUserAbilityEntity(abilityName: 'guest'))->toArray());

        $create = $this->statusUserService->createOrUpdate(
            statusUserDataInterface: $statusUserData,
            useProposedCode: ! ! @mb_strlen($guestDefaultCode),
        );

        tbconfigvalue(
            configPath: sprintf('%s.%s', UserStatusConfigInterface::CONFIG_NAME, UserStatusConfigInterface::DEFAULT_STATUS_CODE),
            setValue: $create['data'][StatusUserInterface::ATTRIBUTE_CODE],
        );

        TemporaryDataHelper::forget(key: 'tbusv1_ignore_gate');

        return $create['status'];
    }
}
