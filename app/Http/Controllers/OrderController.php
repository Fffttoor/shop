<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders =  Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = CartService::getCart();
        $cart->load(['items','items.product']);
        $cartItems = $cart->items;
        if($cartItems->isEmpty()) return redirect()->route('dashboard');
        $totalPrice = 0;
        foreach($cartItems as $item)
            $totalPrice += $item->price * $item->quantity;
        return view('client.orders.create', compact('cart','cartItems','totalPrice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'delivery' => 'required|in:postal_service,self_delivery',
            'payment' => 'required|in:online,postpaid',
            'total_price' => 'required|numeric|min:0',
        ]);

        $cart = CartService::getCart();
        $cart->load(['items','items.product']);
        $cartItems = $cart->items;

        $validated['status'] = 'new';
        $validated['user_id'] = Auth::id();

        $order = Order::create($validated);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        $cart->items()->delete();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) return redirect()->route('dashboard') ;
        $order->load('items.product');
        return view('client.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {

        $order->load('items.product');

        return view('admin.orders.edit', compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,finished'
        ]);

        $order->update($validated);

        return redirect()->route('orders.index', $order)
            ->with('status', 'Status changed successfully!');
    }
}
