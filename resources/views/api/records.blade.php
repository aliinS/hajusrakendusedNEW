<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div class="relative bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md transition-transform transform hover:-translate-y-2">
                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-md">New</div>
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-800">{{ $product['name'] }}</h2>
                                <p class="text-gray-600">Artist: {{ $product['author'] }}</p>
                                <p class="text-gray-600">Tracks: {{ $product['tracks'] }}</p>
                                <div class="mt-4">
                                    <span class="text-xl font-bold text-gray-900">{{ $product['price'] }} €</span>
                                </div>
                            </div>
                        
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
