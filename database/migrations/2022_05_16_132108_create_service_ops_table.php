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
        Schema::create('service_ops', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('service_description')->nullable();
            $table->string('user_id')->nullable();
            $table->string('survey_id')->nullable();
            $table->string('access_radio_ip')->nullable();
            $table->string('station_radio_ip')->nullable();
            $table->string('radio_gateway')->nullable();
            $table->string('port')->nullable();
            $table->string('pop')->nullable();
            $table->string('router_ip')->nullable();
            $table->string('browsing_ip')->nullable();
            $table->string('gateway')->nullable();
            $table->string('vlan_id')->nullable();
            $table->string('circuit_id')->nullable();
            $table->string('data')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('vendor_servicing_the_location')->nullable();
            $table->string('syscodes_router')->nullable();
            $table->string('bandwidth_capacity')->nullable();
            $table->string('account_status')->nullable();
            $table->string('account_owner')->nullable();
            $table->string('activation_date')->nullable();
            $table->string('deactivation_date')->nullable();
            $table->string('outdoor/indoor')->nullable();
            $table->string('latency')->nullable();
            $table->string('signal_strength')->nullable();
            $table->string('signal_Tx')->nullable();
            $table->string('signal_Rx')->nullable();
           


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
        Schema::dropIfExists('service_ops');




    }
};
