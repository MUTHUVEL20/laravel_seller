<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlrprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slrprofiles', function (Blueprint $table) {
            $table->unsignedInteger('sellerid');
            $table->timestamp('creationTime')->useCurrent();
            $table->string('address1', 100);
           $table->string('address2', 100);
            $table->string('landmark', 100);
           $table->string('city', 50);
           $table->string('state', 50);
            $table->smallInteger('countryid');

             $table->string('primarycontact', 50); 
             $table->string('postalcode', 20);
             $table->string('mobileno', 15);
             $table->string('websiteurl', 50);
            $table->string('businesscategory', 25);
            $table->string('businessindustry', 100);
            $table->string('locationlink', 250);
            $table->string('taxname', 50);
            $table->text('keywords');
          

             $table->date('updatedTime')-> default('1000-01-01');
              $table->string('description', 250);
             $table->string('estdYear',4);

               $table->string('sonotify',1);
            
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
        Schema::dropIfExists('slrprofiles');
    }
}
