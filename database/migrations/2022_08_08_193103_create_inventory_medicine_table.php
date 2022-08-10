<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_medicine', function (Blueprint $table) {
            $table->id('im_id');
            $table->string('mi_id');
            $table->string('expiry');
            $table->integer('stockin');
            $table->integer('stockout');
            $table->integer('created_by');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_medicine');
    }
}
