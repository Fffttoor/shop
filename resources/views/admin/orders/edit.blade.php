<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Edit order #{{ $order->id }}</h1>

            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold mb-4">Client Data</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-500">Full name</label>
                                <p class="font-medium">{{ $order->full_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500">Email</label>
                                <p class="font-medium">{{ $order->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500">Phone number</label>
                                <p class="font-medium">{{ $order->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold mb-4">Order Details</h2>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm text-gray-500">Delivery</label>
                                <p class="font-medium">
                                    {{ $order->delivery === 'postal_service' ? 'Postal Service' : 'Self Delivery' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500">Payment</label>
                                <p class="font-medium">
                                    {{ $order->payment === 'online' ? 'Online Payment' : 'Postpaid' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500">Total sum</label>
                                <p class="font-medium">{{ $order->total_price }} $</p>
                            </div>
                        </div>
                    </div>

                    <div class="pb-4">
                        <h2 class="text-xl font-semibold mb-4">Order Status</h2>
                        <select name="status"
                                class="w-full px-4 py-2 border rounded-lg @error('status') border-red-500 @enderror">
                            @foreach(['new' => 'New', 'in_progress' => 'In progress', 'finished' => 'Finished'] as $value => $label)
                                <option value="{{ $value }}"
                                    {{ $order->status === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <x-form.alert-danger :messages="$errors->get('status')" />
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-4">Products</h2>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <h3 class="font-medium">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $item->quantity }} unit × {{ $item->price }} USD
                                        </p>
                                    </div>
                                    <p class="font-medium">{{ $item->quantity * $item->price }} USD</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('orders.index', $order) }}"
                       class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition">
                        Back
                    </a>
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Change status
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
