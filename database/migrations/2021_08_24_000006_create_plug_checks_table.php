<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlugChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plug_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('pass_test');
            $table
                ->enum('repair_type', ['not required', 'earth', 'flash', 'ir'])
                ->default('not required')
                ->nullable();

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
        Schema::dropIfExists('plug_checks');
    }
}
