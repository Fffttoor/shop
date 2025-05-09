<div class="relative mb-8 flex flex-col sm:flex-row  justify-between   items-center bg-white rounded-lg shadow-sm px-5 py-8">

    <h2 class="text-xl font-semibold text-gray-800 mb-4 sm:mb-0">{{__('Search')}}</h2>

    <div class="w-full flex justify-start pl-4">
        <input type="text" id="searchInput" placeholder="Enter product name..."
               class="w-1/2 p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
               autocomplete="off"  wire:model.live.debounce.500ms="searchKey" wire:blur.debounce.1000ms="hideResults">
    </div>

    <div id="resultsContainer" class="absolute @if(!$showResult) hidden @endif top-1  bg-white border border-gray-200 rounded-lg shadow-lg w-50 z-[100] top-[90%]">
        <div class="p-3">
            @if (!empty($products))
                @foreach ($products as $item)
                    <ul class="divide-y divide-gray-100">
                        <li wire:key="{{$item['id']}}" class="p-3 hover:bg-blue-50 transition-colors" data-nofilter="">
                            <a href="{{route('products.show',$item['id'])}}" target="_blank">ID:{{$item['id']." ".$item['name']}}</a>
                        </li>
                    </ul>
                @endforeach
            @else
                <div class="p-4 text-center text-gray-500">
                    No results
                </div>
            @endif
        </div>
    </div>
</div>
