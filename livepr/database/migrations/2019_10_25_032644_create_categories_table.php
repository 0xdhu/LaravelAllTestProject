<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');  /// to video ==> categori_id
            $table->string('channelName');
            $table->integer('programs')->default(0);
            $table->string('hlsUrlPhoneAUTO');
            $table->string('stillImageName');
            $table->integer('under19Content');
            // $table->integer('serviceId');
            //$table->foreign('genreCd')->references('id')->on('commongenres'); ///  from commongenre ==> id
            $table->integer('genreCd');   ///  from commongenre ==> id
            $table->integer('state')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
