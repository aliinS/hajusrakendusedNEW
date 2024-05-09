<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update product') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('patch')
            <x-text-input name="name" value="{{ old('name', $product->name) }}" ></x-text-input>
            <x-text-input name="description" value="{{ old('description', $product->description) }}" ></x-text-input>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('products.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
        <form method="POST" action="{{ route('products.destroy', $product) }}">
            @csrf
            @method('delete')
            <x-danger-button onclick="event.preventDefault(); this.closest('form').submit();">
                delete
            </x-danger-button>
        </form>
    </div>
</x-app-layout>