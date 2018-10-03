<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
           $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nom')->nullable(true);
            $table->string('nature_client')->nullable(true);
            $table->string('client')->nullable(true);
            $table->date('date_prevu_prod')->nullable(true);
            $table->boolean('isValid')->default(false);
            $table->string('version')->nullable(true);
            $table->string('chef_projet')->nullable(true);
            $table->string('email_chef_projet')->nullable(true);
            $table->string('autre_tech')->nullable(true);
            $table->string('prevision')->default('PA');
            $table->integer('port')->nullable(true);
            $table->integer('type_id')->unsigned()->nullable(true);
            $table->foreign('type_id')
                  ->references('id')
                  ->on ('types');
                 
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')
                  ->references('id')
                  ->on ('plans');
            $table->string('documentation')->nullable(true);
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
        Schema::drop('applications');
        Schema::drop('application_technologie');
    }
}
