<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
                        <h2 class="text-2xl font-bold mb-4">Your Cart</h2>
                        @if(session('cart') && count(session('cart')) > 0)
                        <div class="bg-white shadow-lg rounded-lg p-6">
                            @foreach(session('cart') as $productId => $details)
                            <div class="flex justify-between items-center border-b py-3 text-black">
                                <div>
                                    <h3 class="font-semibold">{{ $details['name'] }}</h3>
                                    <p class="text-sm">{{ $details['quantity'] }} x ${{ $details['price'] }}</p>
                                </div>
                                <div>
                                    <span class="text-xl font-bold">${{ $details['quantity'] * $details['price'] }}</span>
                                    <form action="{{ route('removeFromCart', $productId) }}" method="POST" class="inline-block ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            <div class="flex justify-between items-center py-4 text-black">
                                <form action="{{ route('checkout', $productId) }}" method="POST">
                                    @csrf
                                    <button class="bg-blue-500 text-white px-6 py-2 rounded-md">Checkout</button>
                                </form>
                                <span class="text-xl font-bold">Total: ${{ $total }}</span>
                            </div>
                        </div>
                        @else
                        <p>Your cart is empty.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
