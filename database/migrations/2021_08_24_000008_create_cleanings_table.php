<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleanings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('time_started');
            $table->dateTime('time_finished');
            $table->text('inside_before_img')->nullable();
            $table->text('outside_before_img')->nullable();
            $table->text('inside_after_img')->nullable();
            $table->text('outside_after_img')->nullable();

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
        Schema::dropIfExists('cleanings');
    }
}
