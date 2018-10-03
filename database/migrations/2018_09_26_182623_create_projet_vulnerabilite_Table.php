<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetVulnerabiliteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_vulnerabilite', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->integer('projet_id')->unsigned();
        
            $table->integer('vulnerabilite_id')->unsigned()->index();
           
            $table->integer('nbr')->default(0);
            $table->timestamps();
        });
         Schema::table('projet_vulnerabilite', function(Blueprint $table)
        {
            
            $table->foreign('projet_id')
                  ->references('id')
                  ->on ('projets')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('vulnerabilite_id')
                  ->references('id')
                  ->on ('vulnerabilites')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('projet_vulnerabilite');

    }
}
