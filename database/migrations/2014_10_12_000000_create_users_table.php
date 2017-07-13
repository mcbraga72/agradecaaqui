<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('users')) return;
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('surName')->nullable();
            $table->string('gender')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('telephone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('religion')->nullable();
            $table->string('income')->nullable();
            $table->string('sport')->nullable();
            $table->string('otherSport')->nullable();
            $table->string('soccerTeam')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->boolean('hasCar')->nullable();
            $table->boolean('hasChildren')->nullable();
            $table->string('liveWith')->nullable();
            $table->string('pet')->nullable();
            $table->string('otherPet')->nullable();
            $table->string('registerType')->nullable();
            $table->string('photo')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
