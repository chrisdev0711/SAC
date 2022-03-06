<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPlugChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plug_checks', function (Blueprint $table) {
            $table->string('insulation')->nullable(true);
            $table->string('earth')->nullable(true);
            $table->boolean('gas')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plug_checks', function (Blueprint $table) {
            $table->dropColumn('insulation');
            $table->dropColumn('earth');
            $table->dropColumn('gas');
        });
    }
}
