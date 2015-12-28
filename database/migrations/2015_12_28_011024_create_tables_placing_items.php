<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesPlacingItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('placing_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('placing_id')->unsigned();
          $table->foreign('placing_id')->references('id')->on('placings');
          $table->integer('transaction_item_id')->unsigned();
          $table->foreign('transaction_item_id')->references('id')->on('transaction_items');
          $table->integer('qty');
          $table->string('status',50);

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
        //
    }
}
