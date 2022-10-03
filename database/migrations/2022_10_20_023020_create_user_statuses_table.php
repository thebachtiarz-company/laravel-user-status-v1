<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        Schema::create('user_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->unique()->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(StatusUser::class)->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('user_statuses');
    }
};
