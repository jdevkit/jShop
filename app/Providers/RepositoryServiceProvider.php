<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\BookRepository::class, \App\Repositories\Eloquent\BookRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AuthorRepository::class, \App\Repositories\Eloquent\AuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CommentRepository::class, \App\Repositories\Eloquent\CommentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RankRepository::class, \App\Repositories\Eloquent\RankRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GenreRepository::class, \App\Repositories\Eloquent\GenreRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CatRepository::class, \App\Repositories\Eloquent\CatRepositoryEloquent::class);
        //:end-bindings:
    }
}
