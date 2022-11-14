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
        Schema::create('log_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manage_accommodation_id');
            $table->timestamp('checkin');
            $table->timestamp('checkout');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('manage_accommodation_id', 'FK_LOGBOOK_TO_MANACC')->references('id')->on('manage_accommodations')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_book');
    }
};
