<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
             $table->unsignedInteger('sellerid')->autoIncrement();
            
             $table->timestamp('creationTime')->useCurrent();
            $table->string('sellername', 100);
            $table->string('mailid', 100)->unique();
            $table->string('adminpw', 20);
            $table->string('staffpw', 20)->default('');
            $table->string('dbname', 25)->default('')->unique();
            $table->decimal('dbversion', 7, 2)->default(0.00);
            $table->string('storelisting', 4)->default('Live');
            $table->string('acstatus', 15)->default('Live');
            $table->timestamp('lastlogin')->useCurrent();
            $table->decimal('bal_credit', 10, 2)->default(0.00);
            $table->string('aliascity', 105)->default('');
            $table->string('slrrefid', 9)->default('')->unique();
            $table->string('apiusername', 20)->default('');
            $table->string('apipw', 20)->default('');
            $table->timestamp('suspend_date')->useCurrent();
            $table->timestamp('delete_date')->useCurrent();
            $table->string('reason1', 50)->default('');
            $table->string('reason2', 250)->default('');
            $table->decimal('mincredits', 10, 2)->default(0.00);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
