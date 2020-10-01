<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('company')->nullable();
            $table->boolean('is_company')->default(false);
            $table->string('avatar')->nullable();
            $table->boolean('is_merchant')->default(false);
            $table->text('address')->nullable();
            $table->longText('settings')->nullable();
            $table->integer('currency_id')->nullable();
            $table->string('tel_1');
            $table->boolean('tel_1_verified')->default(false);
            $table->string('tel_2')->nullable();
            $table->boolean('tel_2_verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('json_data')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
