<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesMutations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mutations', function (Blueprint $table) {
          $table->increments('id');
          $table->string('no_mutasi',200);
          $table->string('office_sender',100);
          $table->string('division_sender',100);
          $table->string('office_destination',100);
          $table->string('division_destination',100);
          $table->date('date_mutation');
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
