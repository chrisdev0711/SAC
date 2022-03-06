<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('SACNo')->unique();
            $table
                ->enum('Status', [
                    'pending',
                    'checked in',
                    'test & repair',
                    'cleaning',
                    'quality control',
                    'listing',
                    'costing',
                    'ebay',
                    'finalizing',
                    'finalized',
                ])
                ->default('pending');
            $table->string('ModelNumber')->nullable();
            $table->text('Description')->nullable();
            $table->text('Supplier')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('CostExVat', 8, 2)->nullable();
            $table->decimal('VAT', 8, 2)->nullable();
            $table->decimal('CostIncVAT', 8, 2)->nullable();
            $table->string('PONumber')->nullable();
            $table->string('OtherRef')->nullable();
            $table->string('SerialNum')->nullable();
            $table
                ->enum('Grade', ['grade a', 'grade b', 'grade c'])
                ->nullable();

            $table->index('SACNo');

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
        Schema::dropIfExists('appliances');
    }
}
