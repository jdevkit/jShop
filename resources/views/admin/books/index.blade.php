@extends('adminlte::layouts.app')

@section('contentheader_title')
    Books
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
                    @if(\Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="box-header">
                        <h3>All Books</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="{!! route('books.create') !!}" class="btn btn-success">Add new book</a>
                        <div class="table-responsive">
                            <table class="table table-users table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Cover</th>
                                    <th>Genres</th>
                                    <th>Price</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset($books))
                                @foreach($books as $book)
                                    <tr>
                                        <td>{!! $book->id !!}</td>
                                        <td>{!! $book->title !!}</td>
                                        <td>
                                            @foreach($book->authors as $bookAuthor)
                                                <a href="{!! route('authors.show', ['author' => $bookAuthor->id]) !!}">
                                                     {!! $bookAuthor->name !!}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            <img class="table-image" src="/img/covers/{!! $book->image !!}" alt="">
                                        </td>
                                        <td>
                                            @foreach($book->genres as $bookGenre)
                                                <a href="{!! route('genres.show', ['genre' => $bookGenre->id]) !!}">
                                                    {!! $bookGenre->genre !!}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>{!! $book->price !!} $</td>
                                        <td>
                                            <a href="{!! route('books.edit',['book' => $book->id]) !!}" class="btn btn-block btn-warning">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['books.destroy', 'genre' => $book->id], 'method' => 'delete']) !!}
                                            <button type="submit" class="btn btn-block btn-danger">
                                                Delete
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if(false)
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Example box</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            Put your content here
        </div>
        <!-- /.box-body -->
    </div>
@endif
