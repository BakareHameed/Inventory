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
        Schema::create('field_supports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engr_id')->unsigned()->nullable();
            $table->string('ticket_id');
            $table->string('RCA')->nullable();
            $table->string('Resolution')->nullable();
            $table->string('signal_strength')->nullable();
            $table->string('chain_balance')->nullable();
            $table->string('radio_status')->nullable();
            $table->string('additional')->nullable();
            $table->string('client_LAN')->nullable();
            $table->string('pole_status')->nullable();
            $table->string('power_status')->nullable();
            $table->string('RF_status')->nullable();
            $table->string('submitted_at')->nullable();
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
        Schema::dropIfExists('field_supports');
    }
};
