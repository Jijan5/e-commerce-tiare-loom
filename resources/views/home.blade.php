<x-app-layout>
    <main>
        {{-- Hero Section --}}
        <section>
            <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
            <iframe src="//lightwidget.com/widgets/93ac63a1443955b18597607e4dd0baf6.html" scrolling="no"
                allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;">
            </iframe>
        </section>
        {{-- About the Artisan Section --}}
        <section class="bg-white py-20">
            <div class="container mx-auto px-6 md:px-12 grid md:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center md:order-last">
                    {{-- Ganti dengan foto Anda atau workshop Anda --}}
                    <div
                        class="w-80 h-80 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/owner.png') }}" alt="Artisan" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-bold mb-4">From Passion to Product</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Hello! I'm the artisan behind Tiare Loom. Every bag you see is a piece of my passion,
                        meticulously handcrafted with attention to detail. My journey started with a simple love for
                        beads and has blossomed into creating unique pieces that bring joy to others.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        I believe in quality, creativity, and the personal touch that only a handmade item can offer.
                    </p>
                </div>
            </div>
        </section>

        <section class="bg-white p-5">
            <!-- LightWidget WIDGET -->
            <div class="flex justify-between items-baseline mb-4">
                <h2 class="text-3xl font-bold">My Gallery</h2>
                <a href="{{ route('gallery') }}" class="text-lg text-gray-600 hover:text-blue-500 cursor-pointer">Show More &rarr;</a>
            </div>
            <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
            <iframe src="//lightwidget.com/widgets/23bdfaa19e8f5345acbabb572a817d73.html"
                scrolling="no" allowtransparency="true" class="lightwidget-widget"
                style="width:100%;border:0;overflow:hidden;"></iframe>
        </section>

        {{-- Call to Action Section --}}
        <section class="container mx-auto text-center py-20 bg-white">
            <h2 id="cta-headline" class="text-3xl font-bold mb-4" style="min-height: 2.5rem;"></h2>
            <p class="text-lg text-gray-600 mb-8">Let's create a custom beads bag that is uniquely yours.</p>
            <a href="#{{ route('order') }}"
                class="bg-black text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-gray-800 transition-colors duration-300">
                Order Your Custom Bag</a>
        </section>
    </main>

    {{-- Script untuk animasi mengetik pada Call to Action --}}
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctaHeadline = document.getElementById('cta-headline');

            if (ctaHeadline) {
                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        // Periksa apakah elemen masuk ke dalam viewport
                        if (entry.isIntersecting) {
                            // Mulai animasi Typed.js
                            new Typed('#cta-headline', {
                                strings: ["Have a Unique Idea For Your Bag?"],
                                typeSpeed: 40,
                                showCursor: false,
                                cursorChar: '|',
                                loop: false
                            });

                            // Berhenti mengamati elemen setelah animasi dimulai agar tidak berulang
                            observer.unobserve(entry.target);
                        }
                    });
                });
                // Mulai amati elemen target
                observer.observe(ctaHeadline);
            }
        });
    </script>
</x-app-layout>
