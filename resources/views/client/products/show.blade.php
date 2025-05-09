<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <div class="relative group">
                    <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden">
                        @if($product->photo)
                            <img src="{{ asset('storage/'. $product->photo) }}" alt="Product"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-500">
                                {{__('No Image')}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <span class="text-sm text-gray-500">ID: #{{$product->id}}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-1">{{$product->name}}</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-4xl font-bold text-blue-600">{{$product->price}} $</span>
                    </div>
                    <div class="prose max-w-none text-gray-600">
                        <p>{{$product->description}}</p>
                    </div>
                    <livewire:add-to-cart-button :product="$product" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
