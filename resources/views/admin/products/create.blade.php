<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
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
                        <form class="space-y-4" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">{{__('Name')}}</label>
                                <input type="text" id="name" name="name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <x-form.alert-danger :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">{{__('Price')}}</label>
                                <input type="text" id="price" name="price"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <x-form.alert-danger :messages="$errors->get('price')" />
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">{{__('Stock')}}</label>
                                <input type="text" id="stock" name="stock"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <x-form.alert-danger :messages="$errors->get('stock')" />
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">{{__('Description')}}</label>
                                <textarea id="description" name="description" rows="4"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                <x-form.alert-danger :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">{{__('Photo')}}</label>
                                <input type="file"
                                       name="photo"
                                       id="photo"
                                       class="block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700
                           hover:file:bg-indigo-100">
                                <x-form.alert-danger :messages="$errors->get('photo')" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                        class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
