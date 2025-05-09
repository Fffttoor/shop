<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Products catalog')}}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <livewire:search-product/>

        <div class="mb-8 flex flex-col sm:flex-row justify-end items-center  bg-white rounded-lg shadow-sm px-4 py-6">

            <form method="GET" action="{{ route('dashboard') }}" >
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{__('Sort by')}}:</span>
                    <select name = "sort_by"
                        class="block w-48 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="price" {{ $sortBy === 'price' ? 'selected':'' }}>{{__('Price')}}</option>
                        <option value="name" {{ $sortBy === 'name' ? 'selected':'' }}>{{__('Name ')}}</option>
                        <option value="stock" {{ $sortBy === 'stock' ? 'selected':'' }}>{{__('Stock ')}}</option>
                    </select>
                    <span class="text-gray-600">{{__('Sort direction')}}:</span>
                    <select name = "sort_dir"
                        class="block w-48 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="asc" {{ $sortDir === 'asc' ? 'selected':'' }}>{{__('Asc')}}</option>
                        <option value="desc" {{ $sortDir === 'desc' ? 'selected':'' }}>{{__('Des')}}</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        {{__('Sort')}}
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                    <div class="relative aspect-square">
                        @if($product->photo)
                            <img src="{{ asset('storage/'. $product->photo) }}" alt="Product"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-500">
                                {{__('No Image')}}
                            </div>
                        @endif
                        <a href="{{ route('products.show',$product->id) }}" class="absolute bottom-2 right-2 bg-white/90 px-4 py-2 rounded-full text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                            🛍️ {{__('Add to cart')}}
                        </a>
                    </div>
                    <a href="{{ route('products.show',$product->id) }}" class="block p-4 cursor-pointer ">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{$product->name}}</h3>
                        <h3 class="text-lg font-semibold text-gray-600 mb-1">{{__('In stock:')." ".$product->stock}}</h3>
                        <p class="text-xl font-bold text-blue-600">{{$product->price}}$</p>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="py-5 px-7">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
