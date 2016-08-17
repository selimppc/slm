<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 256)->nullable();
            $table->integer('year')->nullable();
            $table->string('file_name', 256)->nullable();
            $table->string('file_path', 256)->nullable();
            $table->string('file_type', 32)->nullable();
            $table->integer('file_size',false,  8)->nullable();
            $table->enum('pdf_type',array('bulletin','alerts','safety'))->nullable();

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
