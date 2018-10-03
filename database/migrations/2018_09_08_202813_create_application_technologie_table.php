<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateApplicationTechnologieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_technologie', function (Blueprint $table) {
           $table->engine = 'InnoDB';
            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')
                  ->references('id')
                  ->on ('applications')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->integer('technologie_id')->unsigned();
            $table->foreign('technologie_id')
                  ->references('id')
                  ->on ('technologies');
                  
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('application_technologie');
    }
}
