<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseBooksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->date('date');
            $table->integer('price')->unsigned();
            $table->string('file');
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('biography');
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genre');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('user_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
        });

        Schema::create('ranks', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');
            $table->integer('grade');
            $table->unique(['user_id','book_id']);
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
        Schema::drop('ranks');
        Schema::drop('comments');
        Schema::drop('genres');
        Schema::drop('authors');
        Schema::drop('books');
    }
}
