<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerInfoInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('customer_info')->default('N/A');
            $table->string('agent_info')->default('N/A');
            $table->unsignedBigInteger('agent_code')->default(0);
            $table->unsignedBigInteger('customer_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('customer_info');
            $table->dropColumn('agent_info');
            $table->dropColumn('agent_code');
            $table->dropColumn('customer_id');
        });
    }
}
