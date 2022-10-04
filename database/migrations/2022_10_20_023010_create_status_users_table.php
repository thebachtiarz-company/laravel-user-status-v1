<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\UserStatus\Interfaces\Model\StatusUserModelInterface;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_users', function (Blueprint $table) {
            $table->id();
            $table->string(StatusUserModelInterface::STATUS_USER_ATTRIBUTE_NAME);
            $table->string(StatusUserModelInterface::STATUS_USER_ATTRIBUTE_CODE)->unique();
            $table->text(StatusUserModelInterface::STATUS_USER_ATTRIBUTE_ABILITIES);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_users');
    }
};
