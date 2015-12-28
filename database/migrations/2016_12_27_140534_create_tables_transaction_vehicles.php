<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTransactionVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transaction_vehicles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('asset_categories_id')->unsigned();
          $table->foreign('asset_categories_id')->references('id')->on('asset_categories');
          $table->integer('trans_gol_id')->unsigned();
          $table->foreign('trans_gol_id')->references('id')->on('trans_gols');
          $table->integer('trans_forvehicle_id')->unsigned();
          $table->foreign('trans_forvehicle_id')->references('id')->on('trans_forvehicles');
          $table->string('index',100);
          $table->string('mdsap',100);
          $table->string('model_vechicle',50);
          $table->string('name',200);
          $table->string('merk',200);
          $table->string('type_vechicle',50);
          $table->string('no_police',50);
          $table->string('no_rangka',50);
          $table->string('no_machine',50);
          $table->string('year_production',20);
          $table->string('silinder',50);
          $table->string('color_kb',50);
          $table->string('color_tnkb',50);
          $table->string('bahan_bakar',50);
          $table->date('date_kir');
          $table->date('date_tax');
          $table->decimal('amount',15,2);
          $table->date('date_amount');
          $table->string('doc_bpkp',50);
          $table->string('doc_stnk',50);
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
