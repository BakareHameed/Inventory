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
        Schema::create('pop_routine_checks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pop_id');
            $table->string('chain_bal');
            $table->string('signal_lvl');
            $table->string('cable_neg');
            $table->string('cable_state');
            $table->string('radio_state');
            $table->string('connector_state');
            $table->string('source_voltage'); 
            $table->string('eqp_housing');
            $table->string('power_ext');
            $table->string('power_bckp');
            $table->string('earthen');
            $table->json('attachments');
            $table->string('additional_info');
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
        Schema::dropIfExists('pop_routine_checks');
    }
};
