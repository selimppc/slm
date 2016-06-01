<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroundHandlingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ground_handling', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name',64)->nullable();
            $table->string('email',256)->nullable();
            $table->string('telephone',64)->nullable();
            $table->string('extension',64)->nullable();
            $table->string('fax',64)->nullable();
            $table->string('location_of_occurrence',64)->nullable();
            $table->string('ramp_condition',64)->nullable();
            $table->string('operational_phase',64)->nullable();
            $table->date('date')->nullable();
            $table->string('time',64)->nullable();
            $table->enum('utc_local',['utc','local'])->nullable();
            $table->string('operator',64)->nullable();
            $table->string('flight_number',64)->nullable();
            $table->string('aircraft_type',64)->nullable();
            $table->string('registration',64)->nullable();
            $table->string('from',64)->nullable();
            $table->string('to',64)->nullable();
            $table->string('delay',64)->nullable();
            $table->string('diversion',64)->nullable();
            $table->string('third_party_involved',64)->nullable();
            $table->mediumText('description_of_occurrence')->nullable();
            $table->string('origin_of_the_goods',64)->nullable();
            $table->string('iata_un_or_id',64)->nullable();
            $table->string('class_or_division',64)->nullable();
            $table->string('subsidiary_risk',64)->nullable();
            $table->enum('packing_group',['I','II','III'])->nullable();
            $table->enum('class_7_category',['I','II','III'])->nullable();
            $table->string('type_of_packing',64)->nullable();
            $table->string('packing_spec_marking',64)->nullable();
            $table->string('number_of_packages',64)->nullable();
            $table->string('quantity_of_transport_index',64)->nullable();
            $table->string('airway_bill_reference',64)->nullable();
            $table->string('courier_pouch_reference',64)->nullable();
            $table->string('shipping_agent',64)->nullable();
            $table->string('shipping_name',64)->nullable();
            $table->string('damage_to',64)->nullable();
            $table->string('damage_by',64)->nullable();
            $table->string('area',64)->nullable();
            $table->mediumText('enviromental_condition')->nullable();
            $table->longText('details_of_damage')->nullable();
            $table->integer('notified_no')->default(0);
            $table->string('reference_no',256)->nullable();
            $table->integer('sent_receive')->default(0);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
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
        Schema::drop('ground_handling');
    }
}
