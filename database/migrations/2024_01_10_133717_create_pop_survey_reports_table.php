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
        Schema::create('pop_survey_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('engr_id')->unsigned()->nullable();
            $table->bigInteger('pop_survey_id')->unsigned()->nullable();
            $table->string('height')->nullable();
            $table->string('distance')->nullable();
            $table->string('power_stability')->nullable();
            $table->string('pop_usability')->nullable();
            $table->string('los')->nullable();
            $table->string('tower_top')->nullable();
            $table->string('feasibillity')->nullable();
            $table->string('feasible_pops')->nullable();
            $table->string('loc_sec');
            $table->longText('suitable_loc', 255)->nullable();
            $table->longText('tower_space_pic', 255)->nullable();
            $table->longText('los_pic', 255)->nullable();
            $table->longText('height_pic', 255)->nullable();
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
        Schema::dropIfExists('pop_survey_reports');
    }
};
