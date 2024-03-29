<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControleProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_projet', function (Blueprint $table) {
           $table->engine = 'InnoDB';
            $table->integer('projet_id')->unsigned();
            $table->foreign('projet_id')
                  ->references('id')
                  ->on ('projets')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('controle_id')->unsigned();
            $table->foreign('controle_id')
                  ->references('id')
                  ->on ('controles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('nbr')->default(0);
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
         Schema::drop('controle_projet');

    }
}
