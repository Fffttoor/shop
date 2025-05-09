<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8"> {{__('Make Order')}}</h1>

        <form action="{{ route('orders.store') }}" method="POST" class="max-w-2xl mx-auto">
            @csrf

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Contact information</h2>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full name *</label>
                        <input type="text" name="full_name" required
                               class="w-full px-3 py-2 border rounded-lg @error('full_name') border-red-500 @enderror"
                               value="{{ old('full_name') }}">
                        <x-form.alert-danger :messages="$errors->get('full_name')" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" required
                               class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror"
                               value="{{ old('email') }}">
                        <x-form.alert-danger :messages="$errors->get('email')" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                        <input type="tel" name="phone" required
                               class="w-full px-3 py-2 border rounded-lg @error('phone') border-red-500 @enderror"
                               value="{{ old('phone') }}" placeholder="+380XXXXXXXXX">
                        <x-form.alert-danger :messages="$errors->get('phone')" />
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Delivery</h2>

                <div class="space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="delivery" value="postal_service" required
                               class="form-radio" checked>
                        <span>Postal service</span>
                    </label>

                    <label class="flex items-center space-x-3">
                        <input type="radio" name="delivery" value="self_delivery"
                               class="form-radio">
                        <span>Self delivery</span>
                    </label>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Payment</h2>

                <div class="space-y-2">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment" value="online" required
                               class="form-radio" checked>
                        <span>Online payment</span>
                    </label>

                    <label class="flex items-center space-x-3">
                        <input type="radio" name="payment" value="postpaid"
                               class="form-radio">
                        <span>Postpaid</span>
                    </label>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Products</h2>

                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between items-center border-b pb-4">
                            <div class="flex justify-between">
                                <div class="relative aspect-square">
                                    @if($item->product->photo)
                                        <img src="{{ asset('storage/'. $item->product->photo) }}" alt="Product"
                                             class="w-32 h-32 object-cover rounded-lg mb-4 sm:mb-0">
                                    @else
                                        <div class="w-32 h-32 text-gray-500 text-center flex justify-center items-center rounded-lg mb-4 sm:mb-0">
                                            <span class="text-gray-500">{{__('No Image')}}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-8">
                                    <h3 class="font-medium">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">{{ $item->quantity * $item->product->price }} $</p>
                                <p class="text-sm text-gray-500">{{ $item->product->price }} $ per unit</p>
                            </div>
                        </div>
                    @endforeach

                    <input type="hidden" value="{{ $totalPrice }}" name = "total_price" >

                    <div class="pt-4 text-xl font-semibold">
                        Total sum: {{ $totalPrice }} $
                    </div>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition">
                Confirm order
            </button>
        </form>
    </div>
</x-app-layout>
