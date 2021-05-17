<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_numbers', function (Blueprint $table) {

            $table->id();

            $table->bigInteger('batch_num')->unique();
            $table->bigInteger('barcode')->unique();
            $table->date('production_date');
            $table->date('expiry_date');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->boolean('drug_drawn')->default(0);

            $table->foreignId('shipment_id')->constrained('shipments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('commercial_id')->constrained('commercial_drugs')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('batch_numbers');
    }
}
