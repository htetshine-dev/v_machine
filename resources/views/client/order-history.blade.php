<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-black text-left">
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Order Id</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Date & Time</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $order)
                                <tr class="border-b border-gray-200">
                                    <td class="px-4 py-3">{{ $key+1 }}</td>
                                    <td class="px-4 py-3">{{ $order->id }}</td>
                                    <td class="px-4 py-3">{{ $order->total_amount }} USD</td>
                                    <td class="px-4 py-3">{{ $order->created_at }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('checkout.success', $order->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">View</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="m-3 text-white">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>