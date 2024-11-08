<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold mb-6">Thank You for Your Order!</h1>
            
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold">Order Details</h2>
            
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
            
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Items:</h3>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
                                        (Added by {{ $item->user->name }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>