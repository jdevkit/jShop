@extends('adminlte::page')

@section('htmlheader_title')
    Authors
@endsection

@section('contentheader_title')
    Authors
@endsection

@section('menu_links')
    <li><a href="{!! route('admin.authors.index') !!}"><i class="fa fa-users"></i> Authors </a></li>
    <li class="active"><i class="fa fa-user"></i> Author</li>
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
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

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-2 col-sm-offset-8">
                                <a class="btn btn-block btn-warning" href="{!! route('admin.authors.edit',['genre' => $author->id]) !!}">
                                    Edit
                                </a>
                            </div>
                            <div class="col-sm-2">
                                {!! Form::open(['route' => ['admin.authors.destroy', 'genre' => $author->id], 'method' => 'delete']) !!}
                                <button type="submit" class="btn btn-block btn-danger">
                                    Delete
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </div>


                    </div>
                </div>

                <h4>Author's books</h4>

                <div class="list-group">
                    @foreach($author->books as $book)
                        <a href="{!! route('admin.books.show',['book' => $book->id]) !!}" class="list-group-item">{!! $book->title !!}</a>
                    @endforeach
                </div>
            </div>
		</div>
	</div>
@endsection
