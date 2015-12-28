<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTransactionProplands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transaction_proplands', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('asset_categories_id')->unsigned();
          $table->foreign('asset_categories_id')->references('id')->on('asset_categories');
          $table->integer('trans_gol_id')->unsigned();
          $table->foreign('trans_gol_id')->references('id')->on('trans_gols');
          $table->integer('trans_statuscert_id')->unsigned();
          $table->foreign('trans_statuscert_id')->references('id')->on('trans_statuscerts');
          $table->integer('trans_forland_id')->unsigned();
          $table->foreign('trans_forland_id')->references('id')->on('trans_forlands');
          $table->integer('trans_investors_id')->unsigned();
          $table->foreign('trans_investors_id')->references('id')->on('trans_investors');
          $table->integer('trans_statusland_id')->unsigned();
          $table->foreign('trans_statusland_id')->references('id')->on('trans_statuslands');
          $table->string('index',100);
          $table->string('mdsap',100);
          $table->string('no_cert',150);
          $table->string('name',200);
          $table->date('date_cert');
          $table->date('date_expired_cert');
          $table->string('name_owner',200);
          $table->decimal('amount',15,2);
          $table->date('date_amount');
          $table->string('land_ha',200);
          $table->string('lat',200);
          $table->string('lang',200);
          $table->string('doc_land',50);
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
