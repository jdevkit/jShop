@extends('adminlte::layouts.app')

@section('contentheader_title')
    Authors
@endsection

@section('menu_links')
    <li><a href="{!! route('authors.index') !!}"><i class="fa fa-users"></i> Authors </a></li>
    <li class="active">Edit Author</li>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
                    @if(\Session::has('message'))
                        <div class="alert alert-danger" role="alert">
                            {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="box-header">
                        @if(isset($author))
                            <h3>Update an Author</h3>
                        @else
                        <h3>Create a new Author</h3>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="panel panel-default creation">

                            @if(isset($author))
                                {!! Form::model($author,[
                                'files' => true,
                                'route' => ['authors.update', 'author'=> $author->id],
                                'method' => 'put'
                                ]) !!}
                            @else
                                {!! Form::open(['route' => 'authors.store',
                                'files' => true]) !!}
                            @endif
                            <div class="panel-body">

                                <div class="input-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="name">Name</span>
                                    <input type="text" name="name" class="form-control" placeholder="Name" aria-describedby="name" value="{!! isset($author) ? $author->name : null !!}">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <div class="form-group {{ $errors->has('biography') ? ' has-error' : '' }}">
                                    <label for="biography">Biography</label>
                                    <textarea class="form-control" rows="5" id="biography" name="biography">@if(isset($author)){!! trim($author->biography) !!}@endif</textarea>
                                </div>
                                @if ($errors->has('biography'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('biography') }}</strong>
                                    </span>
                                @endif

                                <div class="fileinput fileinput-new {{ $errors->has('image') ? ' has-error' : '' }}" data-provides="fileinput">
                                    @if(isset($author))
                                        <img class="table-image" src="/img/authors/{!! $author->image !!}" alt="">
                                    @endif
                                    <span class="btn btn-default btn-file"><span>Choose author's photo</span><input type="file" name="image" accept="image" /></span>
                                    <span class="fileinput-filename"></span><span class="fileinput-new">No file chosen</span>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <br>

                            </div>
                            <div class="panel-footer">
                                {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('adminlte::layouts.partials.scripts')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection
