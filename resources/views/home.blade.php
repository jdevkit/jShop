@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($books as $book)
            <div class="col-sm-3">
                <a href="{!! route('books.show', $book->id) !!}" class="bordered-feature-image">
                    <img class="book-image" src="/img/covers/{!! $book->image !!}" alt="{!! $book->title !!}">
                </a>
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
                <h2>{!! $book->title !!}</h2>
                        <p class="book-description">{!! mb_strimwidth($book->description, 0 ,60) !!} ...
                        <hr>
                        <p class="genres">Genres:
                            @foreach($book->genres as $genre)
                                <a href="{!! route('user.genre.show',['id' => $genre->id]) !!}">{!! $genre->genre !!}</a>
                            @endforeach
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{!! route('user.book.show',['id' => $book->id]) !!}" class="btn-block button-big button-big--green">Show</a>
                            </div>
                            @if (!Auth::guest())
                                <div class="col-sm-6">
                                    <a href="#" data-id="{!! $book->id !!}" class="buy btn-block button-big">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        Buy({!! $book->price !!} $)
                                    </a>
                                </div>
                            @endif
                        </div>
            </div>
        @endforeach

    </div>
</div>
@endsection

