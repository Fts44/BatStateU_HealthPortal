<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_documents', function (Blueprint $table) {
            $table->id('pd_id');
            $table->string('dt_id');
            $table->string('filename');
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('verified')->default(0);
            $table->string('acc_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_documents');
    }
}
