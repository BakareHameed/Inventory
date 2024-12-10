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
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('survey_id')->unsigned()->nullable();
            $table->bigInteger('field_engr');
            $table->bigInteger('raised_by')->nullable();
            $table->bigInteger('edited_by')->nullable();
            $table->bigInteger('reviewed_by')->nullable();
            $table->bigInteger('approved_by')->nullable();
            $table->string('approved_on')->nullable();
            $table->string('items')->nullable();
            $table->string('qty')->nullable();
            $table->string('cost')->nullable();
            $table->string('store_remark')->nullable();
            $table->string('ser_ops_comment')->nullable();
            $table->string('sum')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_orders');
    }
};
