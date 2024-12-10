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
        Schema::create('ip_address', function (Blueprint $table) {
            $table->id();

            $table->string('ip_address')->nullable();
            $table->string('port')->nullable();
            $table->string('vlan_id')->nullable();
            $table->string('MAC_address')->nullable();
            $table->string('subnet_mask')->nullable();
            $table->string('gateway')->nullable();
            $table->string('device_type')->nullable();
            $table->string('queue_name')->nullable();
            $table->string('assigned_bandwidth')->nullable();
            $table->string('user_id')->nullable();
            $table->string('survey_id')->nullable();

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
        Schema::dropIfExists('ip_address');
    }
};
