@extends('adminlte::layouts.app')

@section('contentheader_title')
    Comments
@endsection

@section('menu_links')
    <li class="active"><i class="fa fa fa-comments-o"></i> Comments</li>
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
                        <div class="table-responsive">
                            <table class="table table-users table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Text</th>
                                    <th>Rank</th>
                                    <th>User Name</th>
                                    <th>Book title</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset($comments))
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{!! $comment->id !!}</td>
                                            <td>{!! $comment->text !!}</td>
                                            <td>{!! $comment->rank !!} / 5</td>
                                            <td>{!! $comment->user->name !!}</td>
                                            <td>{!! $comment->book->title !!}</td>
                                            <td>
                                                <a class="btn btn-warning" href="{!! route('comments.edit',['genre' => $comment->id]) !!}">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['comments.destroy', 'genre' => $comment->id], 'method' => 'delete']) !!}
                                                <button type="submit" class="btn btn-danger">
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
