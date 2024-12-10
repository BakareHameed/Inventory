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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('clients')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('date')->nullable();
            $table->string('service_plan')->nullable();
            $table->string('service_type')->nullable();
            $table->string('corporate')->nullable();
            $table->string('service_type_dep')->nullable();
            $table->string('upload_bandwidth')->nullable();
            $table->string('download_bandwidth')->nullable();
            $table->string('unit')->nullable();
            $table->string('message')->nullable();
            $table->string('status')->nullable();
            $table->string('user_id')->nullable();
            $table->string('survey_id')->nullable();
            $table->string('first_assigned_engr')->nullable();
            $table->string('second_assigned_engr')->nullable();
            $table->string('third_assigned_engr')->nullable();
            $table->string('engr_name')->nullable();
            $table->string('feasibility')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('building_height')->nullable();
            $table->string('distance_from_pop')->nullable();
            $table->string('material')->nullable();
            $table->string('quantity')->nullable();
            $table->string('amount')->nullable();
            $table->string('remark')->nullable();
            $table->string('base_stations')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('deployment_status')->nullable();

          
          
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
        Schema::dropIfExists('appointments');
    }
};
