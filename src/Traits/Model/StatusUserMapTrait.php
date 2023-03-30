<?php

namespace TheBachtiarz\UserStatus\Traits\Model;

use Illuminate\Container\Container;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\Object\StatusUser\AbilityObject;

/**
 * Status User Map Trait
 */
trait StatusUserMapTrait
{
    //

    /**
     * Status user simple list map
     *
     * @return array
     */
    public function simpleListMap(): array
    {
        /** @var StatusUserInterface $this */

        /** @var AbilityObject $abilityObject */
        $abilityObject = Container::getInstance()->make(AbilityObject::class);

        return [
            StatusUserInterface::ATTRIBUTE_NAME => $this->getName(),
            StatusUserInterface::ATTRIBUTE_CODE => $this->getCode(),
            StatusUserInterface::ATTRIBUTE_ABILITIES => $abilityObject->decode($this->getAbilities())
        ];
    }
}
