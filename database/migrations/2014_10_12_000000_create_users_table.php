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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('img')->default("http://localhost:8000/default.png");
            $table->string('country');
            $table->integer('age');
            $table->integer('gender')->default(1); // 1 is male 2 is female
            $table->integer('online')->default(0); // 0 is offline 1 is online
            $table->integer('status')->default(0); // 0 is active 1 is inactive
            $table->string('coordinates')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_action')->nullable();
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
