<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabinCrewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabin_crew', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 64)->nullable();
            $table->string('email',64)->nullable();
            $table->string('telephone',64)->nullable();
            $table->string('extension',64)->nullable();
            $table->string('fax',64)->nullable();
            $table->string('captain',64)->nullable();
            $table->enum('pf_pnf',array('pf','pnf'))->nullable();
            $table->string('co_pilot',64)->nullable();
            $table->enum('pf_pnf2',array('pf','pnf'))->nullable();
            $table->string('others',64)->nullable();
            $table->string('purser',64)->nullable();
            $table->dateTime('date',64)->nullable();
            $table->string('time',64)->nullable();
            $table->enum('utc_local',array('utc','local'))->nullable();
            $table->string('air_craft_type',64)->nullable();
            $table->string('registration',64)->nullable();
            $table->string('flight_no',64)->nullable();
            $table->string('from',64)->nullable();
            $table->string('to',64)->nullable();
            $table->string('flt_diverted_to',64)->nullable();
            $table->string('assigned_door',64)->nullable();
            $table->string('position_during_event',64)->nullable();
            $table->string('nr_of_pax',64)->nullable();
            $table->string('nr_of_crew',64)->nullable();
            $table->string('previous_flights',200)->nullable();
            $table->string('nr_of_landings_of_the_day',200)->nullable();
            $table->enum('flight_phase',array('parked','push_back','taxi_out','take_off','initial_climb','climb','cruise','holding','descent','approach','landing','taxi_in'))->nullable();
            $table->text('description_of_occurrence', 512)->nullable();
            $table->integer('notified_no')->default(0);
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
        Schema::drop('cabin_crew');
    }
}
