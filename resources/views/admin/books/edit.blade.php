@extends('adminlte::layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
@endsection

@section('contentheader_title')
    Books
@endsection

@section('menu_links')
    <li><a href="{!! route('books.index') !!}"><i class="fa fa-book"></i> Books </a></li>
    <li class="active"><i class="fa fa-book"></i> Edit Book</li>
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
                        <h3>Create a new book</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="panel panel-default creation">

                            @if(isset($book))
                                {!! Form::model($book,[
                                'files' => true,
                                'route' => ['books.update', 'book' => $book->id],
                                ]) !!}
                            @else
                                {!! Form::open(['route' => 'books.store',
                                'files' => true]) !!}
                            @endif
                            <div class="panel-body">

                                <div class="input-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="title">Title</span>
                                    <input type="text" name="title" class="form-control" placeholder="Title" aria-describedby="title" value="{!! isset($book) ? $book->title : old('title') !!}">
                                </div>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="5" id="description" name="description">{!! isset($book) ? $book->description : old('description') !!}</textarea>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group {{ $errors->has('authors') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="authors">Authors</span>
                                    <select name="authors[]" class="selectpicker form-control" aria-describedby="authors" multiple title="Choose author(s)">
                                        @foreach($authors as $author)
                                        <option value="{!! $author->id !!}" @if(isset($book) && $book->authors->find($author->id)) selected @endif>{!! $author->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('authors'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('authors') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <div class="input-group {{ $errors->has('genres') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="authors">Genres</span>
                                    <select name="genres[]" class="selectpicker form-control" aria-describedby="genres" multiple title="Choose genre(s)">
                                        @foreach($genres as $genre)
                                        <option value="{!! $genre->id !!}" @if(isset($book) && $book->genres->find($genre->id)) selected @endif >{!! $genre->genre !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('genres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('genres') }}</strong>
                                    </span>
                                @endif
                                <br>



                                <div class="fileinput fileinput-new {{ $errors->has('image') ? ' has-error' : '' }}" data-provides="fileinput">
                                    <span class="btn btn-default btn-file"><span>Choose cover image</span><input type="file" name="image" accept="image" /></span>
                                    <span class="fileinput-filename"></span><span class="fileinput-new">No file chosen</span>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <div class="input-group {{ $errors->has('date') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="date">Date (Year)</span>
                                    <input type="text" name="date" class="form-control" placeholder="Date" aria-describedby="date" value="{!! isset($book) ? $book->date : old('date') !!}">
                                </div>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <div class="input-group {{ $errors->has('price') ? ' has-error' : '' }}">
                                    <span class="input-group-addon" id="price">Price</span>
                                    <input type="text" class="form-control" name="price" placeholder="Price" aria-describedby="price" value="{!! isset($book) ? $book->price : old('price') !!}">
                                </div>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <div class="fileinput fileinput-new {{ $errors->has('file') ? ' has-error' : '' }}">
                                    <span class="btn btn-default btn-file"><span>Choose file</span><input type="file" name="file" /></span>
                                    <span class="fileinput-filename"></span><span class="fileinput-new">No file chosen</span>
                                </div>
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
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

@section('scripts')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
@endsection
