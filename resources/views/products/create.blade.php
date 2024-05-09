<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add products') }}
        </h2>
    </x-slot>
    <div class="flex flex-col max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('products.store') }}" class="flex flex-col gap-2">
            @csrf
            @method('post')
            <x-text-input name="name" placeholder="Product name"></x-text-input>
            <x-text-input name="description" placeholder="Product description"></x-text-input>
            <x-text-input name="price" placeholder="Product price"> €</x-text-input>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Add product') }}</x-primary-button>
                <a href="{{ route('products.index') }}">{{ __('Cancel') }}</a>
            </div>
            
        </form>
    </div>
</x-app-layout>