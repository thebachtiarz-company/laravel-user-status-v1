<?php

declare(strict_types=1);

namespace TheBachtiarz\UserStatus\Gates;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use TheBachtiarz\UserStatus\Helpers\StatusUserHelper;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Models\Object\StatusUser\AbilityObject;
use TheBachtiarz\UserStatus\Models\User;
use Throwable;

use function app;
use function assert;
use function collect;
use function in_array;
use function request;
use function tbuserstatusconfig;

class AuthorizationGate
{
    // ? Public Methods

    /**
     * Execute gate authorization
     *
     * @param array $allowedActions
     * @param array $onlyStatuses
     *
     * @throws AuthorizationException
     */
    public static function execute(
        array $allowedActions = ['*'],
        array $onlyStatuses = ['*'],
        bool $useTokenAbilities = true,
    ): void {
        if (request()->has(key: 'bypass_password')) {
            $hashCheck = Hash::check(
                value: request()->get(key: 'bypass_password'),
                hashedValue: Hash::make(tbuserstatusconfig(keyName: 'bypass_password', useOrigin: false)),
            );

            if ($hashCheck) {
                return;
            }
        }

        if (! Auth::hasUser()) {
            throw new AuthorizationException('Please do login first!.');
        }

        $_check_1 = in_array('*', $onlyStatuses);
        $_check_2 = in_array('*', $allowedActions);
        $_check_3 = false;
        $_overall = false;

        try {
            $currentUser = Auth::user();
            assert($currentUser instanceof User);

            $statususer = $currentUser->userstatus->statususer;
            assert($statususer instanceof StatusUserInterface);

            /**
             * Check only statuses
             */
            if (! $_check_1) {
                $_check_1 = in_array(
                    needle: $statususer->getCode(),
                    haystack: $onlyStatuses,
                );

                if (! $_check_1) {
                    throw new AuthorizationException();
                }
            }

            /**
             * Check allowed actions
             */
            if (! $_check_2) {
                $_check_2 = static::isAbilitiesContainMatch(
                    statusUserInterface: $statususer,
                    allowedActions: $allowedActions,
                );

                /**
                 * Check using token abilities
                 */
                if ($useTokenAbilities) {
                    $_check_3 = $currentUser->canAny(
                        abilities: $allowedActions,
                    );
                }

                $_check_2u3 = $_check_2 || $_check_3;
            }

            $_overall = $_check_1 && $_check_2u3;
        } catch (AuthorizationException $auth) {
            throw $auth;
        } catch (Throwable) {
            throw new AuthorizationException('Something went wrong.');
        }

        if (! $_overall) {
            throw new AuthorizationException();
        }
    }

    // ? Protected Methods

    // ? Private Methods

    /**
     * Check is user status abilities match with allowed actions
     *
     * @param array $allowedActions
     */
    private static function isAbilitiesContainMatch(StatusUserInterface $statusUserInterface, array $allowedActions): bool
    {
        $abilityObject = app(AbilityObject::class);
        assert($abilityObject instanceof AbilityObject);

        $statusUserHelper = app(StatusUserHelper::class);
        assert($statusUserHelper instanceof StatusUserHelper);

        $statusAbilities = $abilityObject->decode($statusUserInterface->getAbilities());

        $_stringStatusAbilities = $statusUserHelper->implementAbilitiesToString($statusAbilities);

        $schema = collect($_stringStatusAbilities);

        $result = false;

        foreach ($allowedActions as $key => $_allowedAction) {
            if ($schema->contains($_allowedAction)) {
                $result = true;
                break;
            }
        }

        return $result;
    }

    // ? Getter Modules

    // ? Setter Modules
}
