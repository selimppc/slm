<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationalSafetyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operational_safety', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type_of_occurrence',['accident','incident','other_occurrence'])->nullable();
            $table->string('operator', 64)->nullable();
            $table->date('date_of_occurrence')->nullable();
            $table->string('local_time_of_occurrence',64)->nullable();
            $table->date('flight_date')->nullable();
            $table->string('flight_no',64)->nullable();
            $table->string('departure_airport',64)->nullable();
            $table->string('destination_airport',64)->nullable();
            $table->string('aircraft_type',64)->nullable();
            $table->string('aircraft_registration',64)->nullable();
            $table->string('location_of_occurrence',64)->nullable();
            $table->string('origin_of_the_goods',64)->nullable();
            $table->mediumText('description_of_the_occurrence')->nullable();
            $table->string('proper_shipping_name',64)->nullable();
            $table->string('un_or_id_no',64)->nullable();
            $table->string('class_or_division',64)->nullable();
            $table->string('subsidiary_risks',64)->nullable();
            $table->string('packing_group',64)->nullable();
            $table->string('category',64)->nullable();
            $table->string('type_of_packaging',64)->nullable();
            $table->string('packaging_specification_marking',64)->nullable();
            $table->string('no_of_packages',64)->nullable();
            $table->string('quantity',64)->nullable();
            $table->string('reference_no_of_airway_bill',64)->nullable();
            $table->string('reference_no_of_courier',64)->nullable();
            $table->mediumText('name_and_address_of_shipper_agent_passenger')->nullable();
            $table->mediumText('other_relevant_information')->nullable();
            $table->string('name_and_title_of_person_making_report',64)->nullable();
            $table->string('telephone_no',64)->nullable();
            $table->string('company_contact',64)->nullable();
            $table->string('reporter_ref',64)->nullable();
            $table->string('address',200)->nullable();
            $table->string('signature',200)->nullable();
            $table->date('date_of_signature')->nullable();
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
        Schema::drop('operational_safety');
    }
}
