<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_commercials', function (Blueprint $table) {

            $table->id();
            $table->foreignId('commercial_id')->constrained('commercial_drugs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('diseases_id')->constrained('diseases')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['commercial_id', 'diseases_id']);

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
        Schema::dropIfExists('diseases_commercials');
    }
}
