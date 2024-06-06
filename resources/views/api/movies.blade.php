<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                        <div class="relative bg-white border border-gray-200 rounded-lg overflow-hidden shadow-lg transform transition-transform hover:-translate-y-2">
                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full h-48 object-cover">
                            <div class="p-6 text-center">
                                <h2 class="text-lg font-bold text-gray-800">{{ $product['title'] }}</h2>
                                <p class="text-gray-700 underline">Rating: {{ $product['movie_rating'] }}</p>
                                <p class="text-gray-700 underline">Ranking: {{ $product['rank'] }}</p>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
