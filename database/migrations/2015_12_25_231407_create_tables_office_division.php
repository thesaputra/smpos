<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesOfficeDivision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('office_divisions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('office_id')->unsigned();
          $table->foreign('office_id')->references('id')->on('offices');
          $table->string('code',100);
          $table->string('name',100);
          $table->string('abbreviation',200);
          $table->date('date_open');

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
        Schema::drop('office_divisions');
    }
}
