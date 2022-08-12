<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('acc_id');
            $table->string('sr_code', 20)->unique()->nullable();
            $table->string('gsuite_email', 100)->unique()->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('contact', 20)->unique()->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('suffix_name', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('classification')->nullable();
            $table->string('position')->nullable();
            $table->string('profile_pic', 255)->nullable();
            $table->string('password', 100);
            $table->boolean('is_verified')->default(0);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('gl_id')->nullable();
            $table->integer('dept_id')->nullable();
            $table->integer('prog_id')->nullable();
            $table->integer('home_address_id')->nullable();
            $table->integer('birth_address_id')->nullable();
            $table->integer('dorm_address_id')->nullable();
            $table->integer('ec_id')->nullable()->unique();
            $table->integer('fd_id')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
