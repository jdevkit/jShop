@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{!! $book->title !!}</h3>

                <div>
                    <div class="image">
                        <img class="show-image" src="/img/covers/{!! $book->image !!}" alt="">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <?php if ($book->rank() >= $i){
                                        $star = 'fa-star';
                                    } else {
                                        $star = 'fa-star-o';
                                    }?>
                                    <i class="fa {!! $star !!}" aria-hidden="true"></i>
                                @endfor
                            </div>
                        </div>
                        @if (!Auth::guest())
                            <div class=" pull-right col-sx-6 col-sm-3   col-md-4  col-lg-2">
                                <a href="#" data-id="{!! $book->id !!}" class="buy btn-block button-big">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    Buy({!! $book->price !!} $)
                                </a>
                            </div>
                        @endif
                    </div>
                    <p>Author(s):
                        @foreach($book->authors as $author)
                            <a href="{!! route('author.show', $author->id) !!}"> {!! $author->name !!}</a>
                        @endforeach
                    </p>
                    <p>{!! $book->description !!}</p>
                </div>

                <a class="button-big button-big--green comments-add">Add a Comment</a>

                <div class="comments-form hidden">
                    {!! Form::open([
                    'route' => ['user.comment.create', 'id' => $book->id]
                    ]) !!}
                    Rank a book
                    <div class="form-group {{ $errors->has('rank') ? 'has-error' : '' }}">
                        <div class="stars-ratings">
                            <input type="radio" name="rank" id="rating-5" value="5">
                            <label for="rating-5"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rank" id="rating-4" value="4">
                            <label for="rating-4"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rank" id="rating-3" value="3">
                            <label for="rating-3"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rank" id="rating-2" value="2">
                            <label for="rating-2"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rank" id="rating-1" value="1">
                            <label for="rating-1"><i class="fa fa-star"></i></label>
                        </div>
                        @if($errors->has('rank'))
                            <span class="help-block">{!! $errors->get('rank')[0] !!}</span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label>
                            Comment:
                        </label>
                        <textarea class="form-control" name="text" id="" rows="5"></textarea>
                        @if($errors->has('text'))
                            <span class="help-block">{!! $errors->get('text')[0] !!}</span>
                        @endif
                    </div>
                            <button type="submit" class="button-big pull-right  ">Send</button>
                    {!! Form::close() !!}
                </div>

                <h4 class="centered">Book's comments</h4>

                @if(!$book->comments()->count())
                    <p>There's no comments for this book yet.</p>
                @endif

                <div class="list-group">
                    @foreach($book->comments as $comment)
                        <hr>
                            @for ($i = 1; $i <= 5; $i++)
                                <?php if ($comment->rank >= $i){
                                    $star = 'fa-star';
                                } else {
                                    $star = 'fa-star-o';
                                }?>
                                <i class="fa {!! $star !!}" aria-hidden="true"></i>
                            @endfor
                                <p>{!! $comment->text !!}</p>
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-6">
                                    Author: {!! $comment->user->name !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! $comment->created_at->format('H:i d-m-Y') !!}
                                </div>
                            </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/comments.js"></script>
@endsection
