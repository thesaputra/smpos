<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTransactionItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transaction_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('asset_categories_id')->unsigned();
          $table->foreign('asset_categories_id')->references('id')->on('asset_categories');
          $table->integer('trans_gol_id')->unsigned();
          $table->foreign('trans_gol_id')->references('id')->on('trans_gols');
          $table->integer('trans_investors_id')->unsigned();
          $table->foreign('trans_investors_id')->references('id')->on('trans_investors');
          $table->integer('trans_unit_id')->unsigned();
          $table->foreign('trans_unit_id')->references('id')->on('trans_units');
          $table->integer('trans_conditions_id')->unsigned();
          $table->foreign('trans_conditions_id')->references('id')->on('trans_conditions');
          $table->string('index',100);
          $table->string('mdsap',100);
          $table->string('nsdp',50);
          $table->string('name',200);
          $table->string('merk',200);
          $table->decimal('amount',15,2);
          $table->date('date_amount');
          $table->string('description',200);

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
