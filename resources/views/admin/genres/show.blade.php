@extends('adminlte::page')

@section('contentheader_title')
    Genres
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-9 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">{!! $genre->genre !!}</h3>
                    </div>

                    <div class="panel-body">
                        <div class="list-group">
                            @foreach($genre->books as $book)
                                <a href="{!! route('books.show',['book' => $book->id]) !!}" class="list-group-item">{!! $book->title !!}</a>
                            @endforeach
                        </div>
                    </div>


                </div>
			</div>
		</div>
	</div>
@endsection
