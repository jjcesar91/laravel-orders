<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->smallInteger('order_row')->nullable();
            $table->string('sku')->nullable();
            $table->string('description')->nullable();
            $table->smallInteger('qty')->nullable();

            $table->float('price_unit')->nullable();
            $table->float('price_tot')->nullable();

            $table->smallInteger('discount1')->nullable();
            $table->smallInteger('discount2')->nullable();
            $table->smallInteger('tax')->nullable();
            $table->smallInteger('qty_min')->nullable();

            $table->unsignedBigInteger('order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
