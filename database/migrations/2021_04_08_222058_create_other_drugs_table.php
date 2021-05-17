<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_drugs', function (Blueprint $table) {

            $table->id();
            $table->string('name',30);
            $table->string('dosage',40);
            $table->date('start_use_date');
            $table->date('end_use_date');
            $table->string('purpose_use',40);
            
            $table->foreignId('side_effect_id')->constrained('side_effects')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('other_drugs');
    }
}
