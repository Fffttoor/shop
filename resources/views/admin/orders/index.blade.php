<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mx-auto container bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <x-form.dis-alert-success class="w-1/2 mx-4"/>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('ID')}}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('User data')}}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Total price')}}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Status')}}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Created at')}}
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{__('Action')}}
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$order->id}}
                                    </td>
                                    <td class="px-6 py-4 flex flex-col whitespace-nowrap ">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{$order->full_name}}
                                        </span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{$order->email}}
                                        </span> <span class="text-sm font-medium text-gray-900">
                                            {{$order->phone}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$order->total_price}} $</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$order->created_at}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex">
                                        <a href="{{ route('orders.edit',$order) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">{{__('Edit')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="py-5 px-7">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
