<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->middleware('auth');
        $this->bookRepository = $bookRepository;
    }

    public function show()
    {
        $books = [];
        foreach (\Cart::getContent() as $item) {
            $book = $this->bookRepository->find($item->id);
            $book->quantity = $item->quantity;
            $books[] = $book;
        }
        return view('cart',['books' => $books]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->get('productId');
        $book = $this->bookRepository->find($id);

        \Cart::add(array(
            'id' => $id,
            'name' => $book->title,
            'price' => $book->price,
            'quantity' => 1,
        ));

        return \Cart::getTotalQuantity();
    }

    public function addItem(Request $request)
    {
        $id = $request->get('productId');
        \Cart::update($id, [
            'quantity' => 1,
        ]);

        $data = [
            'total' => \Cart::getTotal(),
            'quantity' => \Cart::get($id)->quantity,
            'id' => $id,
            'cart' => \Cart::getTotalQuantity(),
            'summ' =>\Cart::get($id)->getPriceSum()
        ];

        return $data;
    }

    public function deductItem(Request $request)
    {
        $id = $request->get('productId');
        \Cart::update($id, [
            'quantity' => -1,
        ]);

        $data = [
            'total' => \Cart::getTotal(),
            'quantity' => \Cart::get($id)->quantity,
            'id' => $id,
            'cart' => \Cart::getTotalQuantity(),
            'summ' =>\Cart::get($id)->getPriceSum()
        ];

        return $data;
    }

    public function deleteItem(Request $request)
    {
        $id = $request->get('productId');
        \Cart::remove($id);

        $data = [
            'cart' => \Cart::getTotalQuantity(),
            'total' => \Cart::getTotal(),
            'id' => $id,
        ];

        return $data;
    }

    public function clearCart()
    {
        \Cart::clear();
        return redirect()->back();
    }

    public function getTotalQuantity()
    {
        return \Cart::getTotalQuantity();
    }
}
