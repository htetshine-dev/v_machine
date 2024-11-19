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
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @foreach($products as $product)
                                        <div class="bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 rounded-lg shadow-lg overflow-hidden">
                                            <div class="p-6 text-white">
                                                <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                                <p class="text-sm mt-2">{{ $product->in_stock }}</p>
                                                <div class="mt-4 flex items-center justify-between">
                                                    <span class="text-xl font-bold">${{ $product->price }} USD</span>
                                                    @if($product->in_stock > 0)
                                                    <form action="{{ route('addToCart', $product->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded-md hover:bg-blue-100 focus:outline-none">
                                                            Add to Cart
                                                        </button>
                                                    </form>
                                                    @elseif($product->in_stock == 0)
                                                        <button class="px-4 py-2 text-white bg-gray-500 rounded cursor-not-allowed" disabled>
                                                            Sold Out
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-3 text-white">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
