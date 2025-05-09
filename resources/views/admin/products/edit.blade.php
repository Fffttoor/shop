<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-5 px-7">
                    <a href="{{ route('products.index') }}">
                        <x-button>{{__('Go to all products')}}</x-button>
                    </a>
                </div>
                <div class="mx-auto container rounded-xl shadow-md overflow-hidden flex justify-center">
                    <div class="p-6 w-1/2">
                        <form class="space-y-4" method="POST" action="{{ route('products.update', $product->id ) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{__('Name')}}</label>
                                <input type="text" id="name" name="name" value="{{ $product->name }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <x-form.alert-danger :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">{{__('Price')}}</label>
                                <input type="text" id="price" name="price" value="{{ $product->price }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <x-form.alert-danger :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">{{__('Stock')}}</label>
                                <input type="text" id="stock" name="stock" value="{{ $product->stock }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <x-form.alert-danger :messages="$errors->get('stock')" />
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{__('Description')}}</label>
                                <textarea id="description" name="description" rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ $product->description }}
                                </textarea>
                                <x-form.alert-danger :messages="$errors->get('description')" />
                            </div>

                            <div class="mb-6">
                                @if($product->photo)
                                    <label class="block text-sm font-medium text-gray-700 mb-2">{{__('Current photo')}}</label>
                                    <div id="photoPreview" class="relative group mb-4">
                                        <img src="{{ asset('storage/'. $product->photo) }}"
                                             alt="photo"
                                             class="max-w-xs rounded-lg shadow-md transition-transform duration-300 group-hover:scale-105">

                                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button type="button"
                                                    onclick="confirm('Are you sure?');
                                                    document.getElementById('currentPhoto').value = '';
                                                    document.getElementById('photoPreview').remove();"
                                                    class=" p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                <input id="currentPhoto" type="hidden" name="current_photo" value="{{$product->photo}}">

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">{{__('New photo')}}</label>
                                    <div class="flex items-center">
                                        <input type="file"
                                               name="photo"
                                               id="photo"
                                               class="block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700
                           hover:file:bg-indigo-100">
                                    </div>
                                    <x-form.alert-danger :messages="$errors->get('photo')" />
                                </div>
                            </div>

                           <div class="flex items-center justify-end mt-4">
                                <button type="button" onclick="document.getElementById('deleteForm').submit();"
                                        class="mr-1 flex justify-center py-2 px-4 border border-transparent rounded-md
                                        shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700  focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                                    {{ __('Delete') }}
                                </button>
                                <button type="submit"
                                        class="flex justify-center py-2 px-4 border border-transparent rounded-md
                                        shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Update') }}
                                </button>
                           </div>
                        </form>

                        <form id="deleteForm"  class="" action="{{ route('products.destroy', $product->id) }}" method="POST" >
                            @csrf
                            @method("delete")
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
