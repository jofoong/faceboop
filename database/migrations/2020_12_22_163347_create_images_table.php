<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image', 2083)->nullable();
            $table->integer('imageable_id')->unsigned();
            $table->integer('imageable_type')->unsigned();
            //$table->bigInteger('post_id')->unsigned();
            $table->timestamps();

            //Set the foreign key constraints
            //$table->foreign('post_id')->references('id')->
              //  on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
