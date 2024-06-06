<x-app-layout>
    <div class="m-4 py-10">
        <h2 class="text-3xl font-semibold mb-8 text-center">Shopping Cart</h2>
        @if(session('cart') && count(session('cart')) > 0)
            <div class="flex justify-center">
                <div class="w-full lg:w-2/3">
                    <table class="min-w-full bg-white rounded-lg shadow-lg">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Product</th>
                                <th class="py-2 px-4 border-b">Quantity</th>
                                <th class="py-2 px-4 border-b">Price</th>
                                <th class="py-2 px-4 border-b">Total</th>
                                <th class="py-2 px-4 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $details)
                                <tr>
                                    <td class="py-2 px-4 border-b justify-center">{{ $details['name'] }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <form action="{{ route('cart.update', $id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex space-x-2">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" max="99" class="w-16 text-center border rounded-lg">
                                                <button type="submit" class="px-4 py-1 text-gray-700 rounded-lg">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="py-2 px-4 border-b">€{{ $details['price'] }}</td>
                                    <td class="py-2 px-4 border-b">€{{ $details['price'] * $details['quantity'] }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-1 text-red-600 rounded-lg">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-center mt-6">
                <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg">Continue Shopping</a>
            </div>
            <div class="flex justify-end mt-8">
                <div class="w-full lg:w-2/3 text-right">
                    <h3 class="text-2xl font-semibold mb-4">Total: €{{ $totalAmount }}</h3>
                    <form action="{{ route('checkout.checkout') }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="px-4 py-1 text-red-600 rounded-lg">Proceed to Payment</button>
                    </form>
                </div>
            </div>
        @else
           
        @endif
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.remove-from-cart').click(function () {
                    var productId = $(this).data('id');
        
                    $.ajax({
                        url: `/cart/remove/${productId}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            window.location.reload();
                        },
                        error: function (response) {
                            alert('Error removing product');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
