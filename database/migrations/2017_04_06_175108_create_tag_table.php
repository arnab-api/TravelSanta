<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('hotel_id');
            $table->boolean('hills');
            $table->boolean('sea');
            $table->boolean('river');
            $table->boolean('riverside');
            $table->boolean('lake');
            $table->boolean('forest');
            $table->boolean('green');
            $table->boolean('heritage');
            $table->boolean('architecture');

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
        Schema::drop('tags');
    }
}
