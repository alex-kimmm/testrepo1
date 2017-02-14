<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('image')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('price', 8, 2)->default(0);
            $table->boolean('paid')->default(0);
            $table->string('transaction_id')->default('Unknown')->nullable();
            $table->string('payment_status')->default('Completed')->nullable();
            $table->text('options')->nullable();
            $table->timestamps();
        });

        Schema::create('order_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
            $table->unique(['order_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_translations');
        Schema::drop('orders');
    }
}
