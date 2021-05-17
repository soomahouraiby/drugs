<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagnitudeDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magnitude_drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magnitude_id')->constrained('magnitudes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('commercial_id')->constrained('commercial_drugs')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['magnitude_id', 'commercial_id']);
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
        Schema::dropIfExists('magnitude_drugs');
    }
}
