<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->integer('usertitle_id')->unsigned()->default('1');

            $table->string('oauth_id')->default('');
            $table->string('oauth_service')->default('');
            $table->string('email');
            $table->string('gender')->nullable();

            $table->string('password')->nullable();
            $table->boolean('activated')->default(0);
            $table->boolean('superuser')->default(0);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('permissions')->nullable();
            $table->text('preferences')->nullable();
            $table->string('token')->nullable();
            $table->string('cart_session_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['oauth_id', 'oauth_service', 'email']);

            $table->foreign('usertitle_id')->references('id')->on('usertitles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
