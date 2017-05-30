@extends('adminlte::layouts.app')

@section('contentheader_title')
    Authors
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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="{!! route('authors.create') !!}" class="btn btn-success">Add a new Author</a>
                        <div class="table-responsive">
                            <table class="table table-users table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Biography</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset($authors))
                                    @foreach($authors as $author)
                                        <tr>
                                            <td>{!! $author->id !!}</td>
                                            <td>{!! $author->name !!}</td>
                                            <td>
                                                <img class="table-image" src="/img/authors/{!! $author->image !!}" alt="">
                                            </td>
                                            <td>{!! $author->biography !!}</td>
                                            <td>
                                                <a class="btn btn-warning" href="{!! route('authors.edit',['genre' => $author->id]) !!}">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['authors.destroy', 'genre' => $author->id], 'method' => 'delete']) !!}
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="{!! route('authors.show', ['author' => $author->id]) !!}">
                                                    Show author's books
                                                </a>
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
