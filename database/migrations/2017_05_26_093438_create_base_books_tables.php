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
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->text('biography');
        });

        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->integer('date');
            $table->integer('price')->unsigned();
            $table->string('file');
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('genre');
        });

        Schema::create('genres_books_pivot', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');;
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');;
            $table->unique(['genre_id','book_id']);
        });

        Schema::create('authors_books_pivot', function (Blueprint $table) {
            $table->integer('author_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');;
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');;
            $table->unique(['author_id','book_id']);
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text')->nullable();
            $table->integer('rank')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');;
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
        Schema::drop('comments');
        Schema::drop('genres_books_pivot');
        Schema::drop('authors_books_pivot');
        Schema::drop('genres');
        Schema::drop('books');
        Schema::drop('authors');
    }
}
