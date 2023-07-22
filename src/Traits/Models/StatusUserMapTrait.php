<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Traits\Models;

use TheBachtiarz\UserStatus\Interfaces\Models\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\Object\StatusUser\AbilityObject;
use TheBachtiarz\UserStatus\Models\StatusUser;

use function app;
use function array_merge;
use function array_unique;
use function assert;

/**
 * Status User Map Trait
 */
trait StatusUserMapTrait
{
    /**
     * Status user simple list map
     *
     * @return array
     */
    public function simpleListMap(array $attributes = []): array
    {
        /** @var StatusUser $this */

        $abilityObject = app(AbilityObject::class);
        assert($abilityObject instanceof AbilityObject);

        $returnAttributes = [
            StatusUserInterface::ATTRIBUTE_NAME,
            StatusUserInterface::ATTRIBUTE_CODE,
            StatusUserInterface::ATTRIBUTE_ABILITIES,
        ];

        $this->makeHidden([
            StatusUserInterface::ATTRIBUTE_ID,
            StatusUserInterface::ATTRIBUTE_CREATEDAT,
            StatusUserInterface::ATTRIBUTE_UPDATEDAT,
        ]);

        $this->setData(
            attribute: StatusUserInterface::ATTRIBUTE_ABILITIES,
            value: $abilityObject->decode($this->getAbilities()),
        );

        return $this->only(attributes: array_unique(array_merge($returnAttributes, $attributes)));
    }
}
