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
                                    <h3>{!! $book->title !!}</h3>
                                    <p class="book-description">{!! mb_strimwidth($book->description, 0 ,60) !!}</p>
                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
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
