<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = CartService::getCart();
        $cart->load(['items','items.product']);
        $cartItems = $cart->items;
        $totalPrice = 0;
        foreach($cartItems as $item)
            $totalPrice += $item->price * $item->quantity;

        return view('client.cart.index', compact('cartItems','totalPrice'));
    }

    public function update(Request $request, cartItem $cartItem ,CartService $cartService)
    {
        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $cartItem->product->stock
            ]
        ]);

        $quantity = $validated['quantity'] - $cartItem->quantity;

        $cartService->addItem($cartItem->product->id,$quantity);

        $cart = $cartItem->cart;
        $cart->load(['items']);
        $cartItems = $cart->items;
        $totalPrice = 0;
        foreach($cartItems as $item)
            $totalPrice += $item->price * $item->quantity;

        return response()->json(['success' => true, 'totalPrice' => $totalPrice]);
    }
}
