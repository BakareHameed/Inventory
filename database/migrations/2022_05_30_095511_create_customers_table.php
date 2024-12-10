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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('clients')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('user_id')->nullable();
            $table->string('date')->nullable();
            $table->string('service_plan')->nullable();
            $table->string('service_type')->nullable();
             $table->string('upload_bandwidth')->nullable();
             $table->string('download_bandwidth')->nullable();
             $table->string('unit')->nullable();
             $table->string('status')->nullable();
             $table->string('activation_deactivation_date')->nullable();
             $table->string('amount_paid')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
