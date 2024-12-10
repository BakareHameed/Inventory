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
        Schema::create('weekly_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('category');
            $table->string('description')->nullable();
            $table->text('status');
            // $table->string('last_mile_update')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamp('recorded_on')->nullable();
            $table->bigInteger('recorded_by')->comment('the personel entering the expenses')->nullable();
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
        Schema::dropIfExists('weekly_expenses');
    }
};
