<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristic_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_characteristic')->unsigned();
            $table->integer('id_modification')->unsigned();
            $table->string('value');
            $table->string('unit')->default(" ");
            $table->foreign('id_characteristic')->references('id')->on('characteristics')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_modification')->references('id')->on('modifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
