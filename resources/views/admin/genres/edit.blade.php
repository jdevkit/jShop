@extends('adminlte::layouts.app')

@section('contentheader_title')
    Authors
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3>Create a new Author</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="panel panel-default creation">

                            @if(isset($genre))
                                {!! Form::model($genre,['files' => true,
                                 'route' => ['genres.update', 'genre' => $genre->id],
                                 'method' => 'put']) !!}
                            @else
                                {!! Form::open(['route' => 'genres.store',
                                'files' => true]) !!}
                            @endif
                            <div class="panel-body">

                                <div class="input-group {{ $errors->has('genre') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="genre">Name</span>
                                    <input type="text" name="genre" class="form-control" placeholder="Genre name" aria-describedby="genre" value="{!! isset($genre) ? $genre->genre : null !!}">
                                </div>
                                @if ($errors->has('genre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('genre') }}</strong>
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
