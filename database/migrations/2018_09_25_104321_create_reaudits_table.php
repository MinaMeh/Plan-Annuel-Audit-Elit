<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReauditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reaudits', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('numero');
            $table->date('date_debut');
            $table->date('date_fin')->nullable(true);
            $table->integer('projet_id')->unsigned();
            $table->foreign('projet_id')
                  ->references('id')
                  ->on ('projets')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::drop('reaudits');
    }
}
