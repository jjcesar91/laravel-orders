<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('code')->nullable();
            $table->string('name')->nullable();
            $table->string('piva')->nullable();
            $table->string('cf')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('province')->nullable();

            $table->string('email1')->nullable();
            $table->string('email2')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
