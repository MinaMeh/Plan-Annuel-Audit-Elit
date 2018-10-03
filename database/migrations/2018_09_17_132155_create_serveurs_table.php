<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serveurs', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->ipAddress('addresse_ip');
            $table->integer('port');
            $table->string('user');
            $table->string('password');
            $table->string('user_ssh');
            $table->string('password_ssh');
            $table->string('tech');
            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')
                  ->references('id')
                  ->on ('applications')
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
        Schema::drop('serveurs');
    }
}
