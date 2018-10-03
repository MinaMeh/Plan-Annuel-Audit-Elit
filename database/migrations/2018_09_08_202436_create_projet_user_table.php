<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_user', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->integer('projet_id')->unsigned();
            $table->foreign('projet_id')
                  ->references('id')
                  ->on ('projets');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on ('users')
                  ->onDelete('set null')
                  ->onUpdate('set null');
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
        Schema::drop('projet_user');
    }
}
