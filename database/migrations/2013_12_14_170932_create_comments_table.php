<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->bigInteger('dog_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();

            //Set the foreign key constraints
            $table->foreign('dog_id')->references('id')->
                on('dogs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->
            on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
