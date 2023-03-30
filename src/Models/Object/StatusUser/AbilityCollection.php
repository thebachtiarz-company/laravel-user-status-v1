<?php

namespace TheBachtiarz\UserStatus\Models\Object\StatusUser;

use TheBachtiarz\Base\App\Libraries\Log\LogLibrary;
use TheBachtiarz\UserStatus\Models\StatusUser;

class AbilityCollection
{
    //

    /**
     * Constructor
     *
     * @param LogLibrary $logLibrary
     */
    public function __construct(
        protected LogLibrary $logLibrary
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

        /** @var StatusUser $statusUser */
        foreach ($statusUsers ?? [] as $key => $statusUser) {
            try {
                $result[] = $statusUser->simpleListMap();
            } catch (\Throwable $th) {
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
