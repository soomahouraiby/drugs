<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {

            $table->id();
            $table->string('name',60);
            $table->string('email', 70)->unique();
            $table->integer('phone')->length(9);
            $table->smallInteger('age')->nullable()->length(3);
            $table->boolean('sex')->nullable();
            $table->string('address',70)->nullable();
            $table->string('adjective', 30)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

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
        Schema::dropIfExists('app_users');
    }
}
