<x-admin-layout>
    {{-- Aset dan Style untuk Trix Editor
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        /* Menyesuaikan Trix Editor dengan tema Tailwind */
        .trix-button-group button { background-color: #f9fafb; }
        .trix-button-group button:hover { background-color: #f3f4f6; }
        .trix-button.trix-active { background-color: #e5e7eb; }
        .trix-button-group--file-tools { display: none; }
        .trix-content ul { list-style-type: disc; margin-left: 1.25rem; }
        .trix-content ol { list-style-type: decimal; margin-left: 1.25rem; }
    </style> --}}
    <h3 class="text-3xl font-medium text-gray-700">Edit Orderan</h3>

    <div class="mt-8">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    {{-- Customer Details --}}
                    <div>
                        <label class="text-gray-700" for="customer_name">Nama Pelanggan</label>
                        <input id="customer_name" name="customer_name" type="text"
                            value="{{ old('customer_name', $order->customer_name) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required>
                    </div>

                    <div>
                        <label class="text-gray-700" for="customer_email">Email Pelanggan</label>
                        <input id="customer_email" name="customer_email" type="email"
                            value="{{ old('customer_email', $order->customer_email) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required>
                    </div>

                    <div>
                        <label class="text-gray-700" for="customer_phone">Telepon Pelanggan</label>
                        <input id="customer_phone" name="customer_phone" type="tel"
                            value="{{ old('customer_phone', $order->customer_phone) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                    </div>

                    <div>
                        <label class="text-gray-700" for="status">Status Pesanan</label>
                        <select id="status" name="status"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">
                            <option value="pending" @selected($order->status == 'pending')>Pending</option>
                            <option value="dikerjakan" @selected($order->status == 'dikerjakan')>Dikerjakan</option>
                            <option value="dikirim" @selected($order->status == 'dikirim')>Dikirim</option>
                            <option value="selesai" @selected($order->status == 'selesai')>Selesai</option>
                            <option value="dibatalkan" @selected($order->status == 'dibatalkan')>Dibatalkan</option>
                        </select>
                    </div>

                    {{-- Shipping Details --}}
                    <div class="sm:col-span-2 border-t mt-4 pt-6">
                        <h4 class="text-lg font-medium text-gray-800">Alamat Pengiriman</h4>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-gray-700" for="shipping_alamat">Alamat</label>
                        <input id="shipping_alamat" name="shipping_alamat" type="text"
                            value="{{ old('shipping_alamat', $order->shipping_alamat) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required>
                    </div>

                    <div>
                        <label class="text-gray-700" for="shipping_provinsi">Provinsi</label>
                        <select id="shipping_provinsi" name="shipping_provinsi"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700" for="shipping_kota_kabupaten">Kab./Kota</label>
                        <select id="shipping_kota_kabupaten" name="shipping_kota_kabupaten"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required disabled>
                            <option value="">-- Pilih Kab./Kota --</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700" for="shipping_kecamatan">Kecamatan</label>
                        <select id="shipping_kecamatan" name="shipping_kecamatan"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required disabled>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700" for="shipping_desa_kelurahan">Kelurahan</label>
                        <select id="shipping_desa_kelurahan" name="shipping_desa_kelurahan"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required disabled>
                            <option value="">-- Pilih Kelurahan --</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-gray-700" for="shipping_rt_rw">RT/RW</label>
                        <input id="shipping_rt_rw" name="shipping_rt_rw" type="text"
                            value="{{ old('shipping_rt_rw', $order->shipping_rt_rw) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required>
                    </div>

                    <div>
                        <label class="text-gray-700" for="shipping_kode_pos">Kode Pos</label>
                        <input id="shipping_kode_pos" name="shipping_kode_pos" type="text"
                            value="{{ old('shipping_kode_pos', $order->shipping_kode_pos) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring"
                            required>
                    </div>

                    {{-- Order Description --}}
                    <div class="sm:col-span-2 border-t mt-4 pt-6">
                        <label class="text-gray-700 text-lg font-medium" for="deskripsi">Deskripsi Pesanan</label>
                        <textarea id="deskripsi" name="deskripsi" rows="6"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring">{{ old('deskripsi', strip_tags($order->deskripsi)) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-8 space-x-4">
                    <a href="{{ route('admin.data-orderan') }}"
                        class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-300 transform bg-white rounded-md border hover:bg-gray-100 focus:outline-none">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Listener untuk Trix Editor untuk memastikan editor siap sebelum memuat konten.
        // document.addEventListener('trix-initialize', function(event) {
        //     const editorElement = event.target;
        //     const hiddenInput = document.getElementById(editorElement.getAttribute('input'));
        //     if (hiddenInput && hiddenInput.value) {
        //         editorElement.editor.loadHTML(hiddenInput.value);
        //     }
        // });

        // Listener untuk sisa halaman (dropdown alamat).
        document.addEventListener('DOMContentLoaded', function() {
            const currentAddress = {
                provinsi: '{{ old('shipping_provinsi', $order->shipping_provinsi) }}',
                kota: '{{ old('shipping_kota_kabupaten', $order->shipping_kota_kabupaten) }}',
                kecamatan: '{{ old('shipping_kecamatan', $order->shipping_kecamatan) }}',
                desa: '{{ old('shipping_desa_kelurahan', $order->shipping_desa_kelurahan) }}'
            };

            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/';
            const provinsiSelect = document.getElementById('shipping_provinsi');
            const kotaSelect = document.getElementById('shipping_kota_kabupaten');
            const kecamatanSelect = document.getElementById('shipping_kecamatan');
            const desaSelect = document.getElementById('shipping_desa_kelurahan');

            function resetAndDisable(selectElement, defaultOptionText) {
                selectElement.innerHTML = `<option value="">${defaultOptionText}</option>`;
                selectElement.disabled = true;
            }

            async function populateSelect(selectElement, url, selectedValue = null) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error(`Failed to fetch ${url}`);
                    const data = await response.json();

                    const defaultOptionText = selectElement.querySelector('option').textContent;
                    selectElement.innerHTML = `<option value="">${defaultOptionText}</option>`;

                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.name;
                        option.dataset.id = item.id;
                        option.textContent = item.name;
                        selectElement.appendChild(option);
                    });

                    selectElement.disabled = false;

                    if (selectedValue) {
                        selectElement.value = selectedValue;
                    }

                    return selectElement.options[selectElement.selectedIndex]?.dataset.id;
                } catch (error) {
                    console.error('Error populating dropdown:', error);
                    return null;
                }
            }

            provinsiSelect.addEventListener('change', function() {
                resetAndDisable(kotaSelect, '-- Pilih Kab./Kota --');
                resetAndDisable(kecamatanSelect, '-- Pilih Kecamatan --');
                resetAndDisable(desaSelect, '-- Pilih Kelurahan --');
                const provinsiId = this.options[this.selectedIndex].dataset.id;
                if (provinsiId) {
                    populateSelect(kotaSelect, `${apiBaseUrl}regencies/${provinsiId}.json`);
                }
            });

            kotaSelect.addEventListener('change', function() {
                resetAndDisable(kecamatanSelect, '-- Pilih Kecamatan --');
                resetAndDisable(desaSelect, '-- Pilih Kelurahan --');
                const kotaId = this.options[this.selectedIndex].dataset.id;
                if (kotaId) {
                    populateSelect(kecamatanSelect, `${apiBaseUrl}districts/${kotaId}.json`);
                }
            });

            kecamatanSelect.addEventListener('change', function() {
                resetAndDisable(desaSelect, '-- Pilih Kelurahan --');
                const kecamatanId = this.options[this.selectedIndex].dataset.id;
                if (kecamatanId) {
                    populateSelect(desaSelect, `${apiBaseUrl}villages/${kecamatanId}.json`);
                }
            });

            async function initializeAddress() {
                const initialProvinsi = currentAddress.provinsi;
                const initialKota = currentAddress.kota;
                const initialKecamatan = currentAddress.kecamatan;
                const initialDesa = currentAddress.desa;

                if (initialProvinsi) {
                    const provinsiId = await populateSelect(provinsiSelect, `${apiBaseUrl}provinces.json`,
                        initialProvinsi);
                    if (provinsiId && initialKota) {
                        const kotaId = await populateSelect(kotaSelect,
                            `${apiBaseUrl}regencies/${provinsiId}.json`, initialKota);
                        if (kotaId && initialKecamatan) {
                            const kecamatanId = await populateSelect(kecamatanSelect,
                                `${apiBaseUrl}districts/${kotaId}.json`, initialKecamatan);
                            if (kecamatanId && initialDesa) {
                                await populateSelect(desaSelect, `${apiBaseUrl}villages/${kecamatanId}.json`,
                                    initialDesa);
                            }
                        }
                    }
                } else {
                    // If no province is set, just load the province list
                    populateSelect(provinsiSelect, `${apiBaseUrl}provinces.json`);
                }
            }

            initializeAddress();
        });
    </script>
</x-admin-layout>
