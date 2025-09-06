<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailIdInDetailStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_statuses', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('order_detail_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_statuses', function (Blueprint $table) {
            //
            $table->dropColumn('order_detail_id');
        });
    }
}
