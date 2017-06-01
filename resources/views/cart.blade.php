@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table show-cart">
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>Author</td>
                                <td>Cover</td>
                                <td>Quantity</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td><b>Total:</b></td>
                            <td colspan="3"></td>
                            <td><b><span class="summ">{!! \Cart::getTotal() !!}</span> $</b></td>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($books as $book)
                            <tr id="book-{!! $book->id !!}">
                                <td>
                                    {!! $book->title !!}
                                </td>
                                <td>
                                    @foreach($book->authors as $author)
                                        {!! $author->name !!},
                                    @endforeach
                                </td>
                                <td>
                                    <img class="table-image" src="/img/covers/{!! $book->image !!}" alt="{!! $book->title !!}">
                                </td>
                                <td class="quantity">
                                    <button class="minus" data-id="{!! $book->id !!}">
                                        <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                    </button>
                                        <span id="{!! $book->id !!}">{!! $book->quantity !!}</span>
                                    <button class="plus" data-id="{!! $book->id !!}">
                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                    </button>
                                </td>
                                <td class="last">
                                    <span id="summ-{!! $book->id !!}">{!! $book->price * $book->quantity !!}</span> $
                                    <a class="delete-item" data-id="{!! $book->id !!}">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="{!! route('user.clear.cart') !!}" class="btn btn-block btn-warning">
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                    Clear Cart
                                </a>
                            </div>
                            <div class="col-sm-3 col-sm-offset-6">
                                <a class="btn btn-success btn-block next">
                                    <i class="fa fa-cc-stripe" aria-hidden="true"></i>
                                    Buy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/cart.js"></script>
@endsection
