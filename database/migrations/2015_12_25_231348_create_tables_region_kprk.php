<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesRegionKprk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('region_kprks', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('region_id')->unsigned();
          $table->foreign('region_id')->references('id')->on('regions');
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
        Schema::drop('region_kprks');
    }
}
