<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('merchant_key');
            $table->string('site_url');
            $table->string('success_link');
            $table->string('fail_link');
            $table->string('logo')->nullable()->default(NULL);
            $table->string('name');
            $table->string('description')->nullable()->default(NULL);
            $table->text('json_data')->nullable()->default(NULL);
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
        Schema::dropIfExists('merchands');
    }
}
