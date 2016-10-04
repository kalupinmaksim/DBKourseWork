<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserautosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userautos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_mark')->unsigned();
            $table->integer('id_model')->unsigned();
            $table->integer('id_generation')->unsigned();
            $table->integer('id_serie')->unsigned();
            $table->integer('id_modification')->unsigned();
            $table->timestamps();
            $table->foreign('id_mark')->references('id')->on('marks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_model')->references('id')->on('models')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_generation')->references('id')->on('generations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_serie')->references('id')->on('series')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_modification')->references('id')->on('modifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')
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
