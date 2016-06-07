<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfidentSafetyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confident_safety', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->nullable();
            $table->string('address',200)->nullable();
            $table->string('email',256)->nullable();
            $table->string('telephone',64)->nullable();
            $table->string('function',64)->nullable();
            $table->string('department',64)->nullable();
            $table->string('aircraft_involved',64)->nullable();
            $table->string('type_of_operation',64)->nullable();
            $table->string('weather',64)->nullable();
            $table->string('flight_phase',64)->nullable();
            $table->text('account_of_event', 512)->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('confident_safety');
    }
}
