<div class="space-y-4">
    <div class="flex items-center space-x-4">
        <label class="text-gray-700"> <span>{{__('Quantity:')}}</span></label>
        <input type="number"
               wire:model="quantity"
               min="1"
               max="{{$product->stock}}"
               class="w-24 px-3 py-2 border border-gray-300 rounded-md text-center" >
        <x-form.alert-danger :messages="$errors->get('quantity')" />
    </div>

    <button  wire:click="addToCart"
        class="w-full flex items-center justify-center space-x-2 py-4 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200
        {{ $inCart ? 'bg-green-600 hover:bg-green-700' : '' }}"  @if($inCart) disabled @endif>
        <span>
            @if($inCart)
                ✓ {{__('In cart')}}
            @else
                🛒 {{__('Add to cart')}}
            @endif
        </span>
    </button>
</div>
