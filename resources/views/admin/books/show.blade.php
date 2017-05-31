@extends('adminlte::page')

@section('contentheader_title')
    Books
@endsection

@section('menu_links')
    <li><a href="{!! route('books.index') !!}"><i class="fa fa-book"></i> Books </a></li>
    <li class="active"><i class="fa fa-book"></i> Show book</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">{!! $book->title !!}</h3>
                    </div>

                    <div class="panel-body">
                        <div class="image">
                            <img class="show-image" src="/img/covers/{!! $book->image !!}" alt="">
                        </div>
                        <hr>
                        {!! $book->description !!}
                    </div>

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-2 col-sm-offset-8">
                                <a class="btn btn-block btn-warning" href="{!! route('authors.edit',['genre' => $book->id]) !!}">
                                    Edit
                                </a>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::open(['route' => ['authors.destroy', 'genre' => $book->id], 'method' => 'delete']) !!}
                                <button type="submit" class="btn btn-block btn-danger">
                                    Delete
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </div>


                    </div>
                </div>

                <h4>Book's comments</h4>

                <div class="list-group">
                    @foreach($book->comments as $comment)
                        <a href="{!! route('comments.edit',['comment' => $comment->id]) !!}" class="list-group-item comment">
                            {!! $comment->text !!}
                            <span class="rank"> {!! $comment->rank !!} / 5 </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
