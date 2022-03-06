<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualityControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('condition', ['grade a', 'grade. b', 'grade c']);
            $table
                ->enum('parts_burners', ['not required', 'yes', 'no'])
                ->default('not required');
            $table
                ->enum('parts_pan_supports', ['not required', 'yes', 'no'])
                ->default('not required');
            $table
                ->enum('parts_grill_tray', ['not required', 'yes', 'no'])
                ->default('not required');
            $table
                ->enum('parts_oven_shelves', ['not required', 'yes', 'no'])
                ->default('not required');
            $table
                ->enum('parts_oven_rails', ['not required', 'yes', 'no'])
                ->default('not required');
            $table
                ->enum('parts_door_glass', ['not required', 'yes', 'no'])
                ->default('not required');
            $table
                ->enum('parts_fridge_shelves', ['not required', 'yes', 'no'])
                ->default('not required');
            $table->mediumText('cosmetic_marks')->nullable();
            $table->text('cosmetic_mark_1_img')->nullable();
            $table->text('cosmetic_mark_2_img')->nullable();
            $table->text('cosmetic_mark_3_img')->nullable();
            $table->text('cosmetic_mark_4_img')->nullable();
            $table->text('cosmetic_mark_5_img')->nullable();
            $table->text('cosmetic_mark_6_img')->nullable();
            $table->text('cosmetic_mark_7_img')->nullable();
            $table->text('cosmetic_mark_8_img')->nullable();
            $table->text('cosmetic_mark_9_img')->nullable();
            $table->text('cosmetic_mark_10_img')->nullable();
            $table->text('cosmetic_mark_11_img')->nullable();
            $table->text('cosmetic_mark_12_img')->nullable();
            $table->text('cosmetic_mark_13_img')->nullable();
            $table->text('cosmetic_mark_14_img')->nullable();

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
        Schema::dropIfExists('quality_controls');
    }
}
