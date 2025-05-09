<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-green-600 mb-2">Order successfully completed!</h1>
                <p class="text-gray-600">Order ID: <span class="font-semibold">#{{ $order->id }}</span></p>
            </div>

            <div class="space-y-6">
                <div class="border-b pb-4">
                    <h2 class="text-xl font-semibold mb-4">Your data</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Full Name:</p>
                            <p class="font-medium">{{ $order->full_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Email:</p>
                            <p class="font-medium">{{ $order->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Phone number:</p>
                            <p class="font-medium">{{ $order->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-b pb-4">
                    <h2 class="text-xl font-semibold mb-4">Delivery</h2>
                    <div class="flex items-center space-x-2">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                        {{ $order->delivery == 'postal_service' ? 'Postal Service' : 'Self Delivery' }}
                    </span>
                    </div>
                </div>

                <div class="border-b pb-4">
                    <h2 class="text-xl font-semibold mb-4">Payment</h2>
                    <div class="flex items-center space-x-2">
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                        {{ $order->payment == 'online' ? 'Online Payment' : 'Postpaid' }}
                    </span>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Products list</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center border-b pb-2">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <h3 class="font-medium">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $item->quantity }} units. × {{ $item->price }} $
                                        </p>
                                    </div>
                                </div>
                                <p class="font-medium">{{ $item->quantity * $item->price }} $</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center pt-6">
                        <span class="text-lg font-semibold">Total sum:</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $order->total_price }} $</span>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">Order Status:
                        @switch($order->status)
                            @case('new')
                                <span class="text-blue-600 font-medium">New</span>
                                @break
                            @case('in_progress')
                                <span class="text-yellow-600 font-medium">In progress</span>
                                @break
                            @case('finished')
                                <span class="text-green-600 font-medium">Done</span>
                                @break
                        @endswitch
                    </p>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('dashboard') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition">
                    To Catalog
                </a>
                <button onclick="window.print()"
                        class="bg-blue-100 text-blue-700 px-6 py-2 rounded-lg hover:bg-blue-200 transition">
                    Print
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
