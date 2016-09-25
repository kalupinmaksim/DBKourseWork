<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifications', function (Blueprint $table) {
            $table->increments('id_modification');
            $table->integer('id_series')->unsigned();
            $table->integer('id_model')->unsigned();
            $table->string('name');
            $table->string('year_start_production');
            $table->string('year_end_production');
            $table->foreign('id_series')->references('id_series')->on('series')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_model')->references('id_model')->on('models')
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
