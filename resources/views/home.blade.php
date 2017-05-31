@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-sm-4 col-md-3">
                            <div class="thumbnail">
                                <img class="book-image" src="/img/covers/{!! $book->image !!}" alt="{!! $book->title !!}">
                                <div class="caption">
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <?php if ($book->rank() >= $i){
                                                $star = 'fa-star';
                                            } else {
                                                $star = 'fa-star-o';
                                            }?>
                                                <i class="fa {!! $star !!}" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <p>Author(s):
                                        @foreach($book->authors as $author)
                                            <a href="{!! route('user.author.show',['id' => $author->id]) !!}"> {!! $author->name !!}</a>
                                        @endforeach
                                    </p>
                                    <h3>{!! $book->title !!}</h3>
                                    <p class="book-description">{!! mb_strimwidth($book->description, 0 ,60) !!} ...
                                    <hr>
                                    <p class="genres">Genres:
                                        @foreach($book->genres as $genre)
                                            <a href="{!! route('user.genre.show',['id' => $genre->id]) !!}">{!! $genre->genre !!}</a>
                                        @endforeach
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{!! route('user.book.show',['id' => $book->id]) !!}" class="btn btn-block btn-warning">Show</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-block btn-success">Buy</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
