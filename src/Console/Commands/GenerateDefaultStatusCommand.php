<?php

namespace TheBachtiarz\UserStatus\Console\Commands;

use Illuminate\Console\Command;
use TheBachtiarz\Base\App\Libraries\Log\LogLibrary;
use TheBachtiarz\UserStatus\Services\StatusUserService;

class GenerateDefaultStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:userstatus:generate:default';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate default user status entity.';

    /**
     * Constructor
     *
     * @param LogLibrary $logLibrary
     * @param StatusUserService $statusUserService
     */
    public function __construct(
        protected LogLibrary $logLibrary,
        protected StatusUserService $statusUserService
    ) {
        parent::__construct();
        $this->logLibrary = $logLibrary;
        $this->statusUserService = $statusUserService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $result = Command::INVALID;

        try {
            $this->logLibrary->log('======> Generate default status user entity, started...');
            $this->info('======> Generate default status user entity, started');

            $data = (new \TheBachtiarz\UserStatus\Models\Data\StatusUserData)
                ->setCode(tbuserstatusconfig('default_status_code'))
                ->setName('Default')
                ->setAbilities(['guest' => ['*']]);
            $create = $this->statusUserService->createOrUpdate($data);
            if (!$create->getId()) throw new \Exception("Failed to create default status user");

            $this->logLibrary->log('======> Generate default status user entity, finished...');
            $this->info('======> Generate default status user entity, finished...');

            $result = Command::SUCCESS;
        } catch (\Throwable $th) {
            $this->logLibrary->log($th);
            $this->warn('======> ' . $th->getMessage());

            $result = Command::FAILURE;
        } finally {
            $this->logLibrary->log('');

            return $result;
        }
    }
}
