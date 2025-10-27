<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountrylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countrylists', function (Blueprint $table) {
            $table->unsignedsmallInteger('countryid');

            $table->string('countryname',100);

            $table->string('dialcode',10);

            $table->string('currencysymbol',15);

            $table->string('currency_code',3);



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countrylists');
    }
}
