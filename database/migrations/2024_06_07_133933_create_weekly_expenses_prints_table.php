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
        Schema::create('weekly_expenses_prints', function (Blueprint $table) {
            $table->id();
            $table->string('summary_by');
            $table->string('week_id');
            $table->string('week');
            $table->decimal('amount_expended', 10, 2)->nullable();
            $table->decimal('surplus', 10, 2)->nullable();
            $table->decimal('amount_recieved', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
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
        Schema::dropIfExists('weekly_expenses_prints');
    }
};
