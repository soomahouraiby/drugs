<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_app_users', function (Blueprint $table) {

            $table->id();
            $table->foreignId('app_user_id')->constrained('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('diseases_id')->constrained('diseases')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['app_user_id', 'diseases_id']);
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
        Schema::dropIfExists('diseases_app_users');
    }
}
