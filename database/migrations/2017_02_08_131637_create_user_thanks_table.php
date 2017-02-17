<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserThanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_thanks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender')->unsigned();
            $table->foreign('sender')->references('id')->on('users');
            $table->integer('receipt')->unsigned();
            $table->foreign('receipt')->references('id')->on('users');
            $table->date('date');
            $table->time('time');
            $table->text('content');
            $table->text('replica')->nullable();
            $table->text('rejoinder')->nullable();            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_thanks');
    }
}
