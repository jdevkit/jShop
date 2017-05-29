@extends('adminlte::layouts.app')

@section('contentheader_title')
    Books
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
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
                                    <th>Description</th>
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
                                        <td>{!! $book->authors->name !!}</td>
                                        <td>Cover</td>
                                        <td>{!! $book->description !!}</td>
                                        <td>{!! $book->price !!}</td>
                                        <td colspan="2">Actions</td>
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
