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
        Schema::create('pop_maintenance', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engr_id')->unsigned()->nullable();
            $table->string('ticket_id');
            $table->string('RCA')->nullable();
            $table->string('Resolution')->nullable();
            $table->string('cable_state')->nullable();
            $table->string('chain_balance')->nullable();
            $table->string('radio_state')->nullable();
            $table->string('connector_state')->nullable();
            $table->string('cable_neg')->nullable();
            $table->string('signal')->nullable();
            $table->string('additional')->nullable();
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
        Schema::dropIfExists('pop_maintenance');
    }
};
