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
        Schema::create('daily_handovers', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('issue');
            $table->dateTime('start_time');
            $table->string('last_mile_update')->nullable();
            $table->string('findings')->nullable();
            $table->string('resolution')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('resolved_by')->nullable();
            $table->string('radio_IP');
            $table->string('pop');
            $table->string('status');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('daily_handovers');
    }
};
