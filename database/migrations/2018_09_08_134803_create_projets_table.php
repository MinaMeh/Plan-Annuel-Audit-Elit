<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
           $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('isValid')->default(false);
            $table->date('date_reception')->nullable(true);
            $table->date('date_debut_audit')->nullable(true);
            $table->date('date_fin_audit')->nullable(true);
            $table->date('date_visa_dssd')->nullable(true);
            $table->date('date_passage_prod')->nullable(true);
            $table->string('etat')->default('Non reçu');
            $table->smallInteger('trimestre')->nullable(true);
            $table->integer('vuln_eleves')->default(0);
            $table->integer('vuln_moyennes')->default(0);
            $table->integer('vuln_faibles')->default(0);
            $table->integer('procedure_id')->unsigned()->nullable();
            $table->foreign('procedure_id')->nullable()
                  ->references('id')
                  ->on ('procedures')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')
                  ->references('id')
                  ->on ('applications');
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->nullable()
                  ->references('id')
                  ->on ('plans')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
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
        Schema::drop('projets');

    }
}
