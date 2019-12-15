<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ring');
            $table->string('permission')->nullable();
            $table->string('role');
            $table->string('type');
            $table->string('shopname');
            $table->string('fname');
            $table->string('lname');
            $table->string('mobile');
            $table->string('industry');
            $table->string('postcode');
            $table->string('country');
            $table->string('email')->unique();
            $table->string('password');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_users');
    }
}
