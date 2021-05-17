<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportAlertDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_alert_drugs', function (Blueprint $table) {

            $table->id();
            $table->string('user_name',30);

            $table->boolean('sex');
            $table->smallInteger('age')->length(3);
            $table->integer('weight')->length(6);
            $table->integer('length')->length(6);
            $table->bigInteger('batch_number');

            $table->longText('method_obtaining');
            $table->string('facility_name',50);
            $table->string('facility_address',50);
            $table->date('start_using_date');
            $table->text('take_drug');
            $table->text('purpose_use');
            $table->string('dosage',100);
            $table->date('stopped_using_date')->nullable();
            $table->boolean('stopped_using');
            $table->longText('describe_problem');
            $table->longText('notes');
            $table->string('relative_relation', 20);


            $table->date('date_report');
            $table->integer('state')->default(0);

            $table->foreignId('app_user_id')->constrained('app_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('types_report_id')->constrained('types_notices')->onDelete('cascade');

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
        Schema::dropIfExists('report_alert_drugs');
    }
}
