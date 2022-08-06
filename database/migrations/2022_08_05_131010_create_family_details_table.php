<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_details', function (Blueprint $table) {
            $table->id('fd_id');
            $table->string('father_fn');
            $table->string('father_mn');
            $table->string('father_ln');
            $table->string('father_sn');
            $table->string('father_occupation');
            $table->string('mother_fn');
            $table->string('mother_mn');
            $table->string('mother_ln');
            $table->string('mother_sn');
            $table->string('mother_occupation');
            $table->string('marital_status');
            $table->json('health_history');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_details');
    }
}
