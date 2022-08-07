<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyHealthHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_health_history', function (Blueprint $table) {
            $table->id('fhh_id');
            $table->boolean('diabetes')->default(0);
            $table->boolean('heart_diesease')->default(0);
            $table->boolean('mental_illness')->default(0);
            $table->boolean('cancer')->default(0);
            $table->boolean('hypertension')->default(0);
            $table->boolean('kidney_diesease')->default(0);
            $table->boolean('epilepsy')->default(0);
            $table->string('others')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_health_history');
    }
}
