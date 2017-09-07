@extends('adminlte::layouts.app')

@section('contentheader_title')
    Genres
@endsection

@section('menu_links')
    <li class="active"><i class="fa fa-list-alt"></i> Genres</li>
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
                        <a href="{!! route('admin.genres.create') !!}" class="btn btn-success">Add new genre</a>
                        <div class="table-responsive">
                            <table class="table table-users table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset($genres))
                                    @foreach($genres as $genre)
                                        <tr>
                                            <td>{!! $genre->id !!}</td>
                                            <td>{!! $genre->genre !!}</td>
                                            <td>
                                                <a class="btn btn-block btn-warning" href="{!! route('admin.genres.edit',['genre' => $genre->id]) !!}">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['admin.genres.destroy', 'genre' => $genre->id], 'method' => 'delete']) !!}
                                                <button type="submit" class="btn btn-block btn-danger">
                                                    Delete
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-block btn-info" href="{!! route('admin.genres.show',['genre' => $genre->id]) !!}">
                                                    Show books
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
