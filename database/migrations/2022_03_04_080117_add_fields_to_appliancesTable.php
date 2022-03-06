<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAppliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appliances', function (Blueprint $table) {
            $table->date('returned_on')->nullable(true)->after('Grade');
            $table->string('returned_reason')->nullable(true)->after('returned_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appliances', function (Blueprint $table) {
            $table->dropColumn('returned_on');
            $table->dropColumn('returned_reason');
        });
    }
}
