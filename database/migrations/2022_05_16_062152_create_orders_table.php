<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->timestamp('registered_at')->nullable();
            $table->smallInteger('status')->nullable();
            $table->smallInteger('info1')->nullable();

            $table->string('pay_info')->nullable();
            $table->string('notes')->nullable();

            $table->float('final_price')->default(0);
            $table->float('discounted_price')->default(0);
            $table->float('total_price')->default(0);

            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('agents');

            $table->unsignedBigInteger('customer_code')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
