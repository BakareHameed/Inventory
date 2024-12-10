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
        Schema::create('installation_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('installation_id')->nullable();
            $table->string('created_date')->nullable();
            $table->string('installed_date')->nullable();
            $table->string('link_status')->nullable();
            $table->string('delivery_comment')->nullable();
            $table->string('duration_hours')->nullable();
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
        Schema::dropIfExists('installation_trackings');
    }
};
