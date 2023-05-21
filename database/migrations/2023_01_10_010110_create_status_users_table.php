<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserInterface;
use TheBachtiarz\UserStatus\Interfaces\Model\UserStatusInterface;
use TheBachtiarz\UserStatus\Models\StatusUser;
use TheBachtiarz\UserStatus\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(StatusUserInterface::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(StatusUserInterface::ATTRIBUTE_NAME);
            $table->string(StatusUserInterface::ATTRIBUTE_CODE)->unique();
            $table->text(StatusUserInterface::ATTRIBUTE_ABILITIES);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(UserStatusInterface::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, UserStatusInterface::ATTRIBUTE_USERID)->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(StatusUser::class, UserStatusInterface::ATTRIBUTE_STATUSUSERID)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(StatusUserInterface::TABLE_NAME);
        Schema::dropIfExists(UserStatusInterface::TABLE_NAME);
    }
};
