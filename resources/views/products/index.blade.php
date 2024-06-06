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
                
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">{{ $product->description }}</p>
                    <p class="text-xl"><strong>Price: {{ $product->price }}</strong> €</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group mb-3">
                            <input type="number" name="quantity" value="1" min="1" class="form-control" placeholder="Quantity">
                            <x-primary-button>{{ __('Add to cart') }}</x-primary-button>
                        </div>
                    </form>
                    <div class="gap-4 mt-2">
                       
                        <a href="{{ route('products.edit', $product) }}" class="text-gray-400">
                            Edit
                        </a>
                    </div>
                </div>
            </div>  
        @endforeach     
    </div>

</x-app-layout>