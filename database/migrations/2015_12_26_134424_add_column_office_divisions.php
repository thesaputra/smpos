<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOfficeDivisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('office_divisions', function($table)
      {
       $table->string('address',200);
       $table->string('pkkk',50);
       $table->string('phone',50);
       $table->string('fax',50);
       $table->string('url_photo',255);
       $table->string('lat',200);
       $table->string('lang',200);
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
