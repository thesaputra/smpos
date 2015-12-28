<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesMutationItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mutation_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('mutation_id')->unsigned();
          $table->foreign('mutation_id')->references('id')->on('mutations');
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
