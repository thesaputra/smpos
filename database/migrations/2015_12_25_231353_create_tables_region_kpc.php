<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesRegionKpc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('region_kpcs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('region_kprk_id')->unsigned();
          $table->foreign('region_kprk_id')->references('id')->on('region_kprks');
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
        Schema::drop('region_kpcs');
    }
}
