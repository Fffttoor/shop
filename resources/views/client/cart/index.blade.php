<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">{{ __('Your Cart') }}</h1>
                <p class="text-gray-600 mt-1">{{ __('Products in cart:')." ".$cartItems->count() }}</p>
            </div>

            <div class="divide-y divide-gray-200">
                @foreach($cartItems as $item)
                    @php
                    $product = $item->product;
                    @endphp
                    <div class="flex flex-col sm:flex-row items-center p-6">
                        @if($product->photo)
                            <img src="{{ asset('storage/'. $product->photo) }}" alt="Product"
                                 class="w-32 h-32 object-cover rounded-lg mb-4 sm:mb-0">
                        @else
                            <div class="w-32 h-32 object-cover rounded-lg mb-4 sm:mb-0 bg-gray-100 flex items-center justify-center text-gray-500">
                                {{__('No Image')}}
                            </div>
                        @endif
                        <div class="flex-1 sm:ml-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{$product->name}}</h3>
                                    <p class="text-sm text-gray-500 mt-1">ID: #{{$product->id}}</p>
                                </div>
                               {{-- <button class="text-gray-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>--}}
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center" x-data="cartItemComponent({{ $item->id }}, {{ $item->quantity }}, '{{ route('cart.update', $item->id) }}')">
                                    <input type="number" name="quantity" min="1"  x-model.number="quantity" @change.debounce.500ms="updateQuantity"
                                           :disabled="updating"  max="{{$product->stock}}" value="{{$item->quantity}}"
                                           class="w-20 text-center border-t border-b border-gray-300">
                                </div>
                                <span class="text-xl font-bold text-blue-600">{{$item->price}}$</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-6 bg-gray-50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-600">{{__('Total')}}:</span>
                    <span id ="totalPrice" class="text-2xl font-bold text-blue-600">{{$totalPrice}}$</span>
                </div>

                <a href="{{route('orders.create')}}" class="block  w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white text-center rounded-lg
                           transition-colors duration-200 font-semibold text-lg">
                    {{__('Make order')}}
                </a>
            </div>
        </div>
        <script>
            function cartItemComponent(itemId, initialQuantity, updateUrl, csrfToken) {
                return {
                    quantity: initialQuantity,
                    updating: false,
                    errors: [],

                    async updateQuantity() {
                        this.updating = true;
                        this.errors = [];

                        const response = await fetch(updateUrl, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                quantity: this.quantity
                            })
                        });

                        const data = await response.json();
                        if (!response.ok) {
                            if (data.errors) {
                                this.errors[itemId] = data.errors.quantity || [];
                            } else {
                                throw new Error('Request failed');
                            }
                        }else{
                            document.getElementById('totalPrice').textContent = data.totalPrice+'$'
                        }
                    }
                }
            }
        </script>
    </div>
</x-app-layout>
