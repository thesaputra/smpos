<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function($table)
      {
       $table->string('nip',200);
       $table->string('employee_name',200);
       $table->string('sex',50);
       $table->string('address',250);
       $table->integer('office_id')->unsigned();
       $table->foreign('office_id')->references('id')->on('offices');
       $table->string('division',200);
       $table->string('phone',100);
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
    }
}
