<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProduct extends Component
{
    public array $products = [];
    public string $searchKey = '';
    public bool $showResult = false;

    public function hideResults()
    {
        $this->showResult = false;
        $this->searchKey = '';
        $this->products = [];
    }

    public function updatedSearchKey()
    {
        $this->showResult = strlen($this->searchKey) > 2;
        $this->products=[];
        if($this->showResult){
            $this->products = Product::where('name', 'like', '%'.$this->searchKey.'%')
                ->take(10)
                ->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.search-product');
    }
}
