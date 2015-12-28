<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTransactionPropbuildings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transaction_propbuildings', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('asset_categories_id')->unsigned();
          $table->foreign('asset_categories_id')->references('id')->on('asset_categories');
          $table->integer('trans_gol_id')->unsigned();
          $table->foreign('trans_gol_id')->references('id')->on('trans_gols');
          $table->integer('trans_forbuilding_id')->unsigned();
          $table->foreign('trans_forbuilding_id')->references('id')->on('trans_forbuildings');
          $table->integer('trans_investors_id')->unsigned();
          $table->foreign('trans_investors_id')->references('id')->on('trans_investors');
          $table->integer('trans_statusbuilding_id')->unsigned();
          $table->foreign('trans_statusbuilding_id')->references('id')->on('trans_statusbuildings');
          $table->string('index',100);
          $table->string('mdsap',100);
          $table->string('name',200);
          $table->string('index_tanah');
          $table->string('lat');
          $table->string('lang');
          $table->string('building_ha');
          $table->decimal('amount',15,2);
          $table->date('date_amount');
          $table->string('floors');
          $table->string('doc_building',50);
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
