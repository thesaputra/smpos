<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesPlacings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('placings', function (Blueprint $table) {
          $table->increments('id');
          $table->string('no_penempatan',200);
          $table->string('office_sender',100);
          $table->string('division_sender',100);
          $table->string('office_destination',100);
          $table->string('division_destination',100);
          $table->date('date_penempatan');
          $table->string('floor',100);
          $table->string('room',100);
          $table->string('description',200);
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
