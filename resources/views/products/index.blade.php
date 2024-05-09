<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
        <div class="flex justify-end">
            <a href="{{ route('products.create') }}"><x-primary-button>{{ __('Add product') }}</x-primary-button></a>
        </div>
    </x-slot>
  
    <div class="grid grid-cols-3 m-24 gap-2">
        @foreach ($products as $product)
            <div class="flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">{{ $product->description }}</p>
                    <p class="text-xl"><strong>Price: {{ $product->price }}</strong> €</p>
                        <div class="py-2 px-3 inline-block bg-white border border-gray-200 rounded-lg" data-hs-input-number="">
                            <div class="flex items-center">
                            <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-decrement="">
                                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                </svg>
                            </button>
                            <input class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center " type="text" value="0" data-hs-input-number-input="">
                            <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-input-number-increment="">
                                <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                                </svg>
                            </button>
                            </div>
                        </div>
                        <div class="gap-4 mt-2">
                        <x-primary-button>{{ __('Add to cart') }}</x-primary-button>
                        <a href="{{ route('products.update', $product) }}" class="text-gray-400">
                            Edit
                        </a>
                        
                        </div>
                    </div>
            </div>  
            @endforeach     
    </div>

</x-app-layout>