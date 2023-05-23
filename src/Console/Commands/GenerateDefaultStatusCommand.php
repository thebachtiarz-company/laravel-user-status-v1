<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use TheBachtiarz\Base\App\Libraries\Log\LogLibrary;
use TheBachtiarz\UserStatus\Models\Data\StatusUserData;
use TheBachtiarz\UserStatus\Services\StatusUserService;
use Throwable;

use function tbuserstatusconfig;

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
     */
    public function __construct(
        protected LogLibrary $logLibrary,
        protected StatusUserService $statusUserService,
    ) {
        parent::__construct();

        $this->logLibrary        = $logLibrary;
        $this->statusUserService = $statusUserService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $result = Command::INVALID;

        try {
            $this->logLibrary->log('======> Generate default status user entity, started...');
            $this->info('======> Generate default status user entity, started');

            $data   = (new StatusUserData())
                ->setCode(tbuserstatusconfig('default_status_code', false))
                ->setName('Default')
                ->setAbilities(['guest' => ['*']]);
            $create = $this->statusUserService->createOrUpdate($data, true);
            if (! $create['status']) {
                throw new Exception('Failed to create default status user');
            }

            $this->logLibrary->log('======> Generate default status user entity, finished...');
            $this->info('======> Generate default status user entity, finished...');

            $result = Command::SUCCESS;
        } catch (Throwable $th) {
            $this->logLibrary->log($th);
            $this->warn('======> ' . $th->getMessage());

            $result = Command::FAILURE;
        } finally {
            $this->logLibrary->log('');

            return $result;
        }
    }
}
