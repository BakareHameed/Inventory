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
        Schema::create('pops', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('site_id')->nullable();
            $table->string('POP_name')->nullable();
            $table->string('POP_router')->nullable();
            $table->string('POP_switch')->nullable();
            $table->string('Trunk_IP')->nullable();
            $table->string('Base_Cluster_IP')->nullable();
            $table->string('Inverter_Power')->nullable();
            $table->string('Third_Party_Vendor')->nullable();
            $table->string('Infrastructure_Type')->nullable();
            $table->string('Tower_Pole_Length')->nullable();
            $table->string('Activated_Date')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
            

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
        Schema::dropIfExists('pops');
    }
};
