<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('regions', function (Blueprint $table) {
          $table->increments('id');
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
      Schema::drop('regions');
    }
}
