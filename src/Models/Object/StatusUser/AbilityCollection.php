<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Models\Object\StatusUser;

use TheBachtiarz\Base\App\Libraries\Log\LogLibrary;
use TheBachtiarz\UserStatus\Models\StatusUser;
use Throwable;

use function assert;

class AbilityCollection
{
    /**
     * Constructor
     */
    public function __construct(
        protected LogLibrary $logLibrary,
    ) {
        $this->logLibrary = $logLibrary;
    }

    // ? Public Methods

    /**
     * Get collection
     *
     * @return array
     */
    public function getCollection(): array
    {
        $statusUsers = StatusUser::all();

        $result = [];

        foreach ($statusUsers ?? [] as $key => $statusUser) {
            assert($statusUser instanceof StatusUser);
            try {
                $result[] = $statusUser->simpleListMap();
            } catch (Throwable $th) {
                $this->logLibrary->log($th);
            }
        }

        return $result;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
