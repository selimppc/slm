<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceOccurrenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_occurrence', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name',64)->nullable();
            $table->string('email',256)->nullable();
            $table->string('telephone',64)->nullable();
            $table->string('extension',64)->nullable();
            $table->string('fax',64)->nullable();
            $table->date('date_of_occurrence')->nullable();
            $table->string('time_of_occurrence',64)->nullable();
            $table->string('shift',64)->nullable();
            $table->string('location_of_occurrence',64)->nullable();
            $table->string('sub_location_of_occurrence',64)->nullable();
            $table->string('mandatory',64)->nullable();
            $table->string('aircraft_type',64)->nullable();
            $table->string('registration',64)->nullable();
            $table->string('operator',64)->nullable();
            $table->string('etops',64)->nullable();
            $table->string('technical_log_ref',64)->nullable();
            $table->string('tag_or_demand_no',64)->nullable();
            $table->string('component',64)->nullable();
            $table->string('part_number',64)->nullable();
            $table->string('serial_number',64)->nullable();
            $table->string('quarantined',64)->nullable();
            $table->string('ata_code',64)->nullable();
            $table->string('ata_sub_code',64)->nullable();
            $table->string('title_of_occurrence',64)->nullable();
            $table->mediumText('description_of_occurrence',64)->nullable();
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
        Schema::drop('maintenance_occurrence');
    }
}
