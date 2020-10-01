<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactionable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('request_id')->nullable();
            $table->integer('transactionable_id');
            $table->string('transactionable_type');
            $table->integer('entity_id');
            $table->string('entity_name');
            $table->integer('state');
            $table->string('currency')->default('F CFA');
            $table->string('activity_title');
            $table->string('money_flow');
            $table->float('amount');
            $table->float('fee')->default(0.00);
            $table->float('amount_net');
            $table->float('balance')->nullable()->default(NULL);
            $table->text('json_data')->nullable();
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
        Schema::dropIfExists('transactionable');
    }
}
