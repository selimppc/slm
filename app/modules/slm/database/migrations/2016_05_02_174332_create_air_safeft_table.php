<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirSafeftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Role */

        Schema::create('air_safety', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 64)->nullable();
            $table->string('email',64)->nullable();
            $table->string('telephone',64)->nullable();
            $table->integer('year')->nullable();
            $table->string('extension',64)->nullable();
            $table->string('fax',64)->nullable();
            $table->string('others',64)->nullable();
            $table->string('captain',64)->nullable();
            $table->enum('pf_pnf',array('pf','pnf'))->nullable();
            $table->string('co_pilot',64)->nullable();
            $table->enum('pf_pnf2',array('pf','pnf'))->nullable();
            $table->dateTime('date',64)->nullable();
            $table->string('time',64)->nullable();
            $table->enum('utc_local',array('utc','local'))->nullable();
            $table->string('air_craft_time',64)->nullable();
            $table->string('registration',64)->nullable();
            $table->string('flight_no',64)->nullable();
            $table->string('from',64)->nullable();
            $table->string('to',64)->nullable();
            $table->string('position',64)->nullable();
            $table->string('altitude',64)->nullable();
            $table->string('speed',64)->nullable();
            $table->string('actual_weight',64)->nullable();
            $table->string('remaining_fuel',64)->nullable();
            $table->string('atl_ref',64)->nullable();
            $table->string('delay',64)->nullable();
            $table->string('diversion',64)->nullable();
            $table->string('nr_crew',64)->nullable();
            $table->string('nr_pax',64)->nullable();
            $table->enum('flight_phase',array('parked','push_back','taxi_out','take_off','initial_climb','climb','cruise','holding','descent','approach','landing','taxi_in'))->nullable();
            $table->text('description_of_occurence', 512)->nullable();
            $table->string('imc_vmc',64)->nullable();
            $table->string('vmc_km',64)->nullable();
            $table->string('wind_direction',64)->nullable();
            $table->string('wind_speed',64)->nullable();
            $table->string('visibility',64)->nullable();
            $table->string('ceiling',64)->nullable();
            $table->string('clouds',64)->nullable();
            $table->string('temperature',64)->nullable();
            $table->string('qnh',64)->nullable();
            $table->enum('weather_condition',array('soft','moderate','severe','turbulence','wind_shear','rain','hail','mist','fog','snow'))->nullable();
            $table->string('runway',64)->nullable();
            $table->enum('runway_condition',array('dry','wet','mist','snow'))->nullable();
            $table->string('rvr',64)->nullable();
            $table->string('auto_pilot',64)->nullable();
            $table->string('auto_thrust',64)->nullable();
            $table->enum('gear',array('up','down'))->nullable();
            $table->string('flap',64)->nullable();
            $table->string('slat',64)->nullable();
            $table->string('spoilers',64)->nullable();
            $table->enum('type_of_alert',array('none','ra','ta'))->nullable();
            $table->string('type_of_ra',64)->nullable();
            $table->enum('ra_followed',array('Yes','No'))->nullable();
            $table->enum('level_of_risk',array('none','low','medium','high'))->nullable();
            $table->enum('evasive_actions',array('yes','no'))->nullable();
            $table->enum('reported_to_atc',array('yes','no'))->nullable();
            $table->enum('atc_instruction',array('none','climb','descent','turn_left','turn_right'))->nullable();
            $table->string('used_frequency',64)->nullable();
            $table->string('heading',64)->nullable();
            $table->string('heading_other_ac',64)->nullable();
            $table->string('ver_seperation',64)->nullable();
            $table->string('hor_seperation',64)->nullable();
            $table->string('type_of_bird',64)->nullable();
            $table->enum('nr_of_birds',array('seen','impact'))->nullable();
            $table->string('size',64)->nullable();
            $table->string('areas_affected',64)->nullable();
            $table->enum('advice_earlier',array('yes','no'))->nullable();
            $table->string('lighting_conditions',64)->nullable();
            $table->enum('conditions_of_the_sky',array('clear','clouded','sky'))->nullable();
            $table->enum('course_ac',array('none','right','left'))->nullable();
            $table->enum('glidslope_position',array('hi','low','on'))->nullable();
            $table->enum('pos_extended_center',array('left','right','on'))->nullable();
            $table->string('change_in_pitch',64)->nullable();
            $table->string('speed_buffet',64)->nullable();
            $table->string('stickshaker',64)->nullable();
            $table->string('suspected_wake_turbulance',64)->nullable();
            $table->string('sign_verticle_accelaration',64)->nullable();
            $table->string('details_ac_wake_turbulance',64)->nullable();
            $table->string('advice_other_aircraft',64)->nullable();
            $table->string('persion_involved',64)->nullable();
            $table->enum('function_position',array('crew','ground','other'))->nullable();
            $table->enum('type_of_influence',array('crew_actions','external','organizations','personal'))->nullable();
            $table->string('comments',64)->nullable();
            $table->integer('notified_no')->default(0);
            $table->string('reference_no',256)->nullable();
            $table->integer('sent_receive')->default(0);
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('attachment',200)->nullable();
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
        Schema::drop('air_safety');
    }
}
