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
        Schema::create('pop_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('raised_by');
            $table->string('POP_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('message')->nullable();
            $table->string('Latitude')->nullable();
            $table->string('Longitude')->nullable();
            $table->integer('first_assgn_engr')->nullable();
            $table->integer('second_assgn_engr')->nullable();
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
        Schema::dropIfExists('pop_surveys');
    }
};
