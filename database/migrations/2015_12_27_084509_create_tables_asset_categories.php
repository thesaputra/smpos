<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesAssetCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('asset_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('asset_type_id')->unsigned();
          $table->foreign('asset_type_id')->references('id')->on('asset_types');
          $table->string('code',100);
          $table->string('name',100);
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
