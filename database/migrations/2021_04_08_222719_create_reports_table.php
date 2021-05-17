<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('batch_number')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->longText('notes_user')->nullable();
            $table->string('district', 20)->nullable();
            $table->string('commercial_name',40)->nullable();
            $table->string('material_name', 40)->nullable();
            $table->decimal('drug_price', 10, 2)->nullable();
            $table->string('company_name',50)->nullable();
            $table->string('agent_name', 50)->nullable();
            $table->dateTime('transfer_date')->nullable();
            $table->string('transfer_party',20)->nullable();
            $table->string('report_statuses',30)->default('بلاغ وارد');
            $table->longText('opmanage_notes')->nullable();
            $table->boolean('state')->default(0);
            $table->string('pharmacy_title',30)->nullable();
            $table->string('street_name',30)->nullable();
            $table->string('neig_name',30)->nullable();
            $table->longText('site_dec')->nullable();
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->boolean('source')->default(false);
            $table->string('amount_name',50)->nullable();
            $table->integer('phone')->length(9)->nullable();
            $table->boolean('sex')->nullable();
            $table->smallInteger('age')->nullable()->length(3);
            $table->string('adjective',30)->nullable();
            $table->string('drug_photo',90)->nullable();


            $table->foreignId('app_user_id')->constrained('app_users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('types_report_id')->constrained('types_reports')->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('reports');
    }
}
