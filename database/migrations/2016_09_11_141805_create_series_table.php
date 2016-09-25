<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_model')->unsigned();
            $table->integer('id_generation')->unsigned();
            $table->string('name');
            $table->foreign('id_model')->references('id')->on('models')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_generation')->references('id')->on('generations')
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
