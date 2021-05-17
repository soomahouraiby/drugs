<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_drugs', function (Blueprint $table) {

            $table->id();

            $table->string('name',50);
            $table->bigInteger('register_no')->unique()->length(15);
            $table->string('drug_entrance',50);
            $table->string('photo',191);
            $table->longText('how_use');
            $table->longText('side_effects');
            $table->smallInteger('drug_form')->length(3);

            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('commercial_drugs');
    }
}
