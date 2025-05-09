<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartService
{
    public static function getCart()
    {
        return auth()->user()->cart ?? auth()->user()->cart()->create();
    }

    public function addItem($productId, $quantity)
    {
        return DB::transaction(function () use ($productId, $quantity) {
            $product = Product::where('id', $productId)
                ->lockForUpdate()
                ->firstOrFail();

            $cart = self::getCart();

            $currentQuantity = $cart->items()
                ->where('product_id', $productId)
                ->value('quantity') ?? 0;

            $newQuantity = $currentQuantity + $quantity;

            if ($product->stock < $quantity)
                throw new \Exception('Not enough product in stock');

            $cart->items()->updateOrCreate(
                ['product_id' => $productId],
                ['quantity' => $newQuantity, 'price' => $product->price]
            );

            $product->decrement('stock', $quantity);

            return $product;
        });
    }

    public static function isInCart($productId)
    {
        return optional(self::getCart()->items())
            ->where('product_id', $productId)
            ->exists();
    }
}
