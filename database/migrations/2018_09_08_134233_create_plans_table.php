<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->smallInteger('annee');
            $table->string('nom');
            $table->string('note')->nullable(true);
            $table->boolean('actuel')->default(true);
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
        Schema::drop('plans');
    }
}
