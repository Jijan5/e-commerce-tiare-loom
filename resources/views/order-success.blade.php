<x-app-layout>
    <main>
        <section class="container mx-auto py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
                {{-- Ikon Sukses --}}
                <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                <h1 class="text-3xl font-bold text-gray-900 mt-4">Thank You For Your Order!</h1>
                <p class="text-gray-600 mt-2">Your order has been received and is now being processed.</p>

                <div class="bg-gray-100 rounded-lg p-4 mt-6 text-left">
                    <p class="text-sm text-gray-700">Order ID:</p>
                    <p class="text-lg font-mono font-bold text-gray-900">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>

                <div class="mt-6 text-left border-t pt-6">
                    <h2 class="text-xl font-semibold text-gray-800">What's Next?</h2>
                    <p class="text-gray-600 mt-2">
                        Our admin will contact you shortly via WhatsApp at the number you provided (<strong>{{ $order->customer_phone }}</strong>) to discuss the details, final price, and shipping costs.
                    </p>
                    <p class="text-gray-600 mt-2">
                        Please wait for our confirmation before making any payments.
                    </p>
                </div>

                <div class="mt-8">
                    <a href="{{ url('/') }}" class="bg-black text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-800 transition-colors duration-300">
                        Back to Home
                    </a>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>