<x-app-layout>
    {{-- Aset dan Style untuk Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        /* Menyesuaikan Trix Editor dengan tema Tailwind */
        .trix-button-group button {
            background-color: #f9fafb;
            /* gray-50 */
        }

        .trix-button-group button:hover {
            background-color: #f3f4f6;
            /* gray-100 */
        }

        .trix-button.trix-active {
            background-color: #e5e7eb;
            /* gray-200 */
        }

        /* Sembunyikan tombol untuk upload file di Trix Editor agar tidak membingungkan */
        .trix-button-group--file-tools {
            display: none;
        }

        .trix-content ul {
            list-style-type: disc;
            margin-left: 1.25rem;
        }
        .trix-content ol {
            list-style-type: decimal;
            margin-left: 1.25rem;
        }
    </style>
    <main>
        <section class="container mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center mb-8">Order Your Custom Bag</h1>

            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto">
                @csrf

                {{-- Informasi Pelanggan (Jika belum login, tampilkan input ini) --}}
                @guest
                    <div class="mb-4">
                        <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                        <input type="text" id="customer_name" name="customer_name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="customer_email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="customer_email" name="customer_email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="customer_phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number
                            (WhatsApp number is preferred)</label>
                        <input type="tel" id="customer_phone" name="customer_phone"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                @endguest

                {{-- Alamat Pengiriman --}}
                <div class="mb-4">
                    <label for="shipping_alamat" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <input type="text" id="shipping_alamat" name="shipping_alamat"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ Auth::check() ? Auth::user()->alamat : '' }}" required>
                </div>
                <div class="mb-4">
                    <label for="shipping_rt_rw" class="block text-gray-700 text-sm font-bold mb-2">RT/RW</label>
                    <input type="text" id="shipping_rt_rw" name="shipping_rt_rw"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ Auth::check() ? Auth::user()->rt_rw : '' }}" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="shipping_provinsi"
                            class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                        <select id="shipping_provinsi" name="shipping_provinsi"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                            <option value="">-- Choose Province --</option>
                        </select>
                    </div>
                    <div>
                        <label for="shipping_kota_kabupaten"
                            class="block text-gray-700 text-sm font-bold mb-2">City/District</label>
                        <select id="shipping_kota_kabupaten" name="shipping_kota_kabupaten"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required disabled>
                            <option value="">-- Choose City/District --</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="shipping_kecamatan"
                            class="block text-gray-700 text-sm font-bold mb-2">Subdistrict</label>
                        <select id="shipping_kecamatan" name="shipping_kecamatan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required disabled>
                            <option value="">-- Choose Subdistrict --</option>
                        </select>
                    </div>
                    <div>
                        <label for="shipping_desa_kelurahan"
                            class="block text-gray-700 text-sm font-bold mb-2">Village/Ward</label>
                        <select id="shipping_desa_kelurahan" name="shipping_desa_kelurahan"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required disabled>
                            <option value="">-- Choose Village/Ward --</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="shipping_kode_pos" class="block text-gray-700 text-sm font-bold mb-2">Postal
                        Code</label>
                    <input type="text" id="shipping_kode_pos" name="shipping_kode_pos"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ Auth::check() ? Auth::user()->kode_pos : '' }}" required>
                </div>

                {{-- Upload File (Multiple) --}}
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <label for="file_foto" class="block text-gray-700 text-sm font-bold">Example Bag Desain</label>
                        <button type="button" id="clear-images-btn" class="text-sm text-red-500 hover:text-red-700"
                            style="display: none;">Delete</button>
                    </div>
                    <input type="file" id="file_foto" name="file_foto[]" multiple
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        accept="image/*" required>
                    {{-- Container untuk preview gambar --}}
                    <div id="image-preview-container" class="mt-4 flex flex-wrap gap-4"></div>
                    <p class="text-gray-600 text-xs italic">Format: JPG, PNG, Max file size: 2MB.</p>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Detail Description</label>
                    <input id="deskripsi" type="hidden" name="deskripsi">
                    <trix-editor input="deskripsi"
                        class="bg-white trix-content shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                        placeholder="Height: 15cm, Width: 15cm, Depth: 15cm, Long strap: 15cm."></trix-editor>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex items-center justify-between">
                    <button
                        class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Order Now
                    </button>
                </div>
            </form>

            {{-- Trix Editor JS --}}
            <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Autofill only if user is logged in and has an address
                    @auth
                    if ({{ Js::from(Auth::user()->alamat !== null) }}) {
                        document.getElementById('shipping_alamat').value = '{{ Auth::user()->alamat }}';
                        document.getElementById('shipping_rt_rw').value = '{{ Auth::user()->rt_rw }}';
                        document.getElementById('shipping_kode_pos').value = '{{ Auth::user()->kode_pos }}';
                    }
                @endauth

                // --- Image Preview Logic ---
                const fileInput = document.getElementById('file_foto');
                const previewContainer = document.getElementById('image-preview-container');
                const clearImagesBtn = document.getElementById('clear-images-btn');

                fileInput.addEventListener('change', function() {
                    previewContainer.innerHTML = ''; // Clear previous previews
                    for (const file of this.files) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('h-24', 'w-24', 'object-cover', 'rounded-md', 'shadow-md');
                            previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }
                    clearImagesBtn.style.display = this.files.length > 0 ? 'block' : 'none';
                });

                clearImagesBtn.addEventListener('click', function() {
                    fileInput.value = null; // Crucial for clearing the selected files
                    previewContainer.innerHTML = '';
                    this.style.display = 'none';
                });

                // --- Indonesian Regions Dropdown Logic ---
                const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/';
                const provinsiSelect = document.getElementById('shipping_provinsi');
                const kotaSelect = document.getElementById('shipping_kota_kabupaten');
                const kecamatanSelect = document.getElementById('shipping_kecamatan');
                const desaSelect = document.getElementById('shipping_desa_kelurahan');

                function resetAndDisable(selectElement, defaultOptionText) {
                    selectElement.innerHTML = `<option value="">${defaultOptionText}</option>`;
                    selectElement.disabled = true;
                }

                // Load Provinsi
                fetch(`${apiBaseUrl}provinces.json`)
                .then(response => response.json())
                .then(provinces => {
                    provinces.forEach(provinsi => {
                        const option = document.createElement('option');
                        option.value = provinsi.name;
                        option.dataset.id = provinsi.id;
                        option.textContent = provinsi.name;
                        provinsiSelect.appendChild(option);
                    });
                });

                // Event listener untuk Provinsi
                provinsiSelect.addEventListener('change', function() {
                    resetAndDisable(kotaSelect, 'Pilih Kota/Kabupaten...');
                    resetAndDisable(kecamatanSelect, 'Pilih Kecamatan...');
                    resetAndDisable(desaSelect, 'Pilih Desa/Kelurahan...');
                    const provinsiId = this.options[this.selectedIndex].dataset.id;
                    if (provinsiId) {
                        fetch(`${apiBaseUrl}regencies/${provinsiId}.json`)
                            .then(response => response.json())
                            .then(regencies => {
                                kotaSelect.disabled = false;
                                regencies.forEach(regency => {
                                    const option = document.createElement('option');
                                    option.value = regency.name;
                                    option.dataset.id = regency.id;
                                    option.textContent = regency.name;
                                    kotaSelect.appendChild(option);
                                });
                            });
                    }
                });

                // Event listener untuk Kota/Kabupaten
                kotaSelect.addEventListener('change', function() {
                    resetAndDisable(kecamatanSelect, 'Pilih Kecamatan...');
                    resetAndDisable(desaSelect, 'Pilih Desa/Kelurahan...');
                    const kotaId = this.options[this.selectedIndex].dataset.id;
                    if (kotaId) {
                        fetch(`${apiBaseUrl}districts/${kotaId}.json`)
                            .then(response => response.json())
                            .then(districts => {
                                kecamatanSelect.disabled = false;
                                districts.forEach(district => {
                                    const option = document.createElement('option');
                                    option.value = district.name;
                                    option.dataset.id = district.id;
                                    option.textContent = district.name;
                                    kecamatanSelect.appendChild(option);
                                });
                            });
                    }
                });

                // Event listener untuk Kecamatan
                kecamatanSelect.addEventListener('change', function() {
                    resetAndDisable(desaSelect, 'Pilih Desa/Kelurahan...');
                    const kecamatanId = this.options[this.selectedIndex].dataset.id;
                    if (kecamatanId) {
                        fetch(`${apiBaseUrl}villages/${kecamatanId}.json`)
                            .then(response => response.json())
                            .then(villages => {
                                desaSelect.disabled = false;
                                villages.forEach(village => {
                                    const option = document.createElement('option');
                                    option.value = village.name;
                                    option.dataset.id = village.id;
                                    option.textContent = village.name;
                                    desaSelect.appendChild(option);
                                });
                            });
                    }
                });
                });
            </script>
        </section>
    </main>
</x-app-layout>
