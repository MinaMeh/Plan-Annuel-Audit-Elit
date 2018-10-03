
<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserappsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userapps', function (Blueprint $table) {
             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('role');
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
        Schema::drop('userapps');
    }
}