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
        Schema::create('pop_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('tickets_id')->nullable();
            $table->bigInteger('assignee_id')->unsigned()->nullable();
            $table->string('purpose')->nullable();
            $table->bigInteger('pop_id')->unsigned()->nullable();
            $table->string('contact_person');
            $table->string('address');
            $table->string('contact_phone');
            $table->string('fault');
            $table->text('fault_details');
            $table->string('fault_level');
            $table->string('fault_type');
            $table->string('fault_owner')->nullable();
            $table->bigInteger('first_engr_id');
            $table->bigInteger('reassignee_id')->unsigned()->nullable();
            $table->bigInteger('prev_engr_id')->nullable();
            $table->string('reassignment_reason')->nullable();
            $table->string('status');
            $table->bigInteger('closed_by_uid')->unsigned()->nullable();
            $table->string('start_time');
            $table->string('accepted_time')->nullable();
            $table->bigInteger('accepted_by')->unsigned()->nullable();
            $table->string('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('closing_remark')->nullable();
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
        Schema::dropIfExists('pop_tickets');
    }
};
