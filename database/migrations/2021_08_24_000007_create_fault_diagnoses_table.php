<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fault_diagnoses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('time_started');
            $table->dateTime('time_finished');
            $table->mediumText('fault_found')->nullable();
            $table->mediumText('parts_required')->nullable();
            $table->boolean('repaired');
            $table->boolean('test_again');

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
        Schema::dropIfExists('fault_diagnoses');
    }
}
