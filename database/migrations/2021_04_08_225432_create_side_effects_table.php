<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSideEffectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('side_effects', function (Blueprint $table) {
            $table->id();

            $table->date('start_side_effect');
            $table->longText('severity');
            $table->boolean('sideshow_still');
            $table->date('date_end_side')->nullable();
            $table->string('patient_condition',191);
            $table->smallInteger('inform_doctor')->length(1);
            $table->string('doctor_name', 30);
            $table->string('doctor_hospital', 30);
            $table->integer('doctor_phone')->length(9);

            $table->foreignId('report_alert_drug_id')->constrained('report_alert_drugs')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('side_effects');
    }
}
