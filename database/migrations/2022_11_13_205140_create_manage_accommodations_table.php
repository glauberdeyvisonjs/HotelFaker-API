<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_accommodations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('accommodation_id');
            $table->unsignedBigInteger('collaborator_id');
            $table->enum('period', ['0', '1', '2'])->comment('0 = per hour, 1 = daily rate, 2 = month rate');
            $table->integer('period_count');
            $table->timestamp('start_time');
            $table->timestamp('final_time');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id', 'FK_MANACC_TO_USER')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('accommodation_id', 'FK_MANACC_TO_ACCID')->references('id')->on('accommodations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('collaborator_id', 'FK_MANACC_TO_COLID')->references('id')->on('collaborators')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_accommodations');
    }
};
