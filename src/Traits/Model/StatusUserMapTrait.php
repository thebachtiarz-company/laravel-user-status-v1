<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Traits\Model;

use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\Object\StatusUser\AbilityObject;

use function app;
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
    public function simpleListMap(): array
    {
        /** @var StatusUserInterface $this */

        $abilityObject = app(AbilityObject::class);
        assert($abilityObject instanceof AbilityObject);

        return [
            StatusUserInterface::ATTRIBUTE_NAME => $this->getName(),
            StatusUserInterface::ATTRIBUTE_CODE => $this->getCode(),
            StatusUserInterface::ATTRIBUTE_ABILITIES => $abilityObject->decode($this->getAbilities()),
        ];
    }
}
