<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class AddToCartButton extends Component
{

    public  $product;

    public int $quantity = 1;
    public bool $inCart = false;

    public function mount()
    {
        $this->checkCartStatus();
    }
    public function rules()
    {
        return [
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $this->product->stock
            ]
        ];
    }

    public function addToCart(CartService $cart)
    {
        $this->validate();
        $cart->addItem($this->product->id, $this->quantity);
        $this->checkCartStatus();
    }

    private function checkCartStatus()
    {
        $this->inCart = auth()->check()
            ? CartService::isInCart($this->product->id)
            : false;
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
