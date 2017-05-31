@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">{!! $author->name !!}</h3>
                    </div>

                    <div class="panel-body">
                        <div class="image">
                            <img class="show-image" src="/img/authors/{!! $author->image !!}" alt="">
                        </div>
                        <hr>
                        {!! $author->biography !!}
                    </div>

                </div>

                <h4>Author's books</h4>

                <div class="list-group">
                    @foreach($author->books as $book)
                        <a href="{!! route('user.book.show',['book' => $book->id]) !!}" class="list-group-item">
                                @for ($i = 1; $i <= 5; $i++)
                                    <?php if ($book->rank() >= $i){
                                        $star = 'fa-star';
                                    } else {
                                        $star = 'fa-star-o';
                                    }?>
                                    <i class="fa {!! $star !!}" aria-hidden="true"></i>
                                @endfor
                             {!! $book->title !!}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

