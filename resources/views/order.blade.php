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

            <div x-data="orderForm()" class="max-w-3xl mx-auto">
                <form x-ref="mainForm" action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
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
                                (WhatsApp number is preferred)
                            </label>
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
                            <label for="file_foto" class="block text-gray-700 text-sm font-bold">Example Bag
                                Desain</label>
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
                        <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Detail
                            Description</label>
                        <input id="deskripsi" type="hidden" name="deskripsi">
                        <trix-editor input="deskripsi"
                            class="bg-white trix-content shadow border rounded w-full py-2 px-3 focus:outline-none focus:shadow-outline"
                            placeholder="Height: 15cm, Width: 15cm, Depth: 15cm, Long strap: 15cm."></trix-editor>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex items-center justify-between">
                        <button @click.prevent="handleOrderSubmit"
                            class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Order Now
                        </button>
                    </div>
                </form>
                <!-- Modal -->
                <div x-show="showModal" x-cloak
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center z-50"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                    <div @click.away="showModal = false"
                        class="relative mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                        <!-- Initial Choice View -->
                        <div x-show="modalView === 'choice'">
                            <div class="mt-3 text-center">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">How would you like to proceed?
                                </h3>
                                <div class="mt-4 px-7 py-3 space-y-4">
                                    <p class="text-sm text-gray-500">
                                        You can continue as a guest, or log in to use your saved address and track your
                                        order history.
                                    </p>
                                </div>
                                <div class="items-center px-4 py-3 space-y-2 sm:space-y-0 sm:flex sm:space-x-4">
                                    <button @click="$refs.mainForm.submit()"
                                        class="w-full sm:w-auto px-4 py-2 bg-gray-200 text-gray-800 rounded-md shadow-sm hover:bg-gray-300 focus:outline-none">
                                        Continue as Guest
                                    </button>
                                    <button @click="modalView = 'login'"
                                        class="w-full sm:w-auto px-4 py-2 bg-black text-white rounded-md shadow-sm hover:bg-gray-800 focus:outline-none">
                                        Login First
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Login Form View -->
                        <div x-show="modalView === 'login'">
                            <div class="mt-3">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Login to your
                                    account</h3>
                                <form @submit.prevent="performAjaxLogin" class="mt-4 space-y-4">
                                    <div x-show="loginError"
                                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                        role="alert">
                                        <span class="block sm:inline" x-text="loginError"></span>
                                    </div>
                                    <div>
                                        <label for="modal_email"
                                            class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" x-model="login.email" id="modal_email"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                                            required>
                                    </div>
                                    <div>
                                        <label for="modal_password"
                                            class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="password" x-model="login.password" id="modal_password"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"
                                            required>
                                    </div>
                                    <div class="items-center pt-3 space-y-2">
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-black text-white rounded-md shadow-sm hover:bg-gray-800 focus:outline-none">
                                            Login & Continue
                                        </button>
                                        <button type="button" @click="modalView = 'choice'"
                                            class="w-full text-center text-sm text-gray-500 hover:text-gray-700">
                                            Back
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Trix Editor JS --}}
            <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

            <script>
                function orderForm() {
                    return {
                        showModal: false,
                        modalView: 'choice', // 'choice' or 'login'
                        login: {
                            email: '',
                            password: ''
                        },
                        loginError: '',

                        handleOrderSubmit() {
                            @guest
                            this.showModal = true;
                        @else
                            this.$refs.mainForm.submit();
                        @endauth
                    },

                    async performAjaxLogin() {
                        this.loginError = '';
                        try {
                            const response = await fetch('{{ route('login.ajax') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify(this.login)
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                throw new Error(data.message || 'Login failed.');
                            }

                            // Login success! Reload the page to update auth state and autofill user data.
                            // The user will then click "Order Now" again to submit.
                            window.location.reload();

                        } catch (error) {
                            this.loginError = error.message;
                        }
                    }
                }
                }
                document.addEventListener('DOMContentLoaded', function() {
                    // Autofill only if user is logged in and has an address
                    @auth
                    if ({{ Js::from(Auth::user()->alamat !== null) }}) {
                        document.getElementById('shipping_alamat').value = '{{ Auth::user()->alamat }}';
                        document.getElementById('shipping_rt_rw').value = '{{ Auth::user()->rt_rw }}';
                        document.getElementById('shipping_kode_pos').value = '{{ Auth::user()->kode_pos }}';
                    }
                    const userAddress = {
                        provinsi: '{{ Auth::user()->provinsi }}',
                        kota: '{{ Auth::user()->kota_kabupaten }}',
                        kecamatan: '{{ Auth::user()->kecamatan }}',
                        desa: '{{ Auth::user()->desa_kelurahan }}'
                    };
                    const hasAddress = !!userAddress.provinsi;
                @else
                    const userAddress = null;
                    const hasAddress = false;
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
                    resetAndDisable(kotaSelect, '-- Choose City/District --');
                    resetAndDisable(kecamatanSelect, '-- Choose Subdistrict --');
                    resetAndDisable(desaSelect, '-- Choose Village/Ward --');
                    const provinsiId = this.options[this.selectedIndex].dataset.id;
                    if (provinsiId) {
                        populateSelect(kotaSelect, `${apiBaseUrl}regencies/${provinsiId}.json`);
                    }
                });

                kotaSelect.addEventListener('change', function() {
                    resetAndDisable(kecamatanSelect, '-- Choose Subdistrict --');
                    resetAndDisable(desaSelect, '-- Choose Village/Ward --');
                    const kotaId = this.options[this.selectedIndex].dataset.id;
                    if (kotaId) {
                        populateSelect(kecamatanSelect, `${apiBaseUrl}districts/${kotaId}.json`);
                    }
                });

                kecamatanSelect.addEventListener('change', function() {
                    resetAndDisable(desaSelect, '-- Choose Village/Ward --');
                    const kecamatanId = this.options[this.selectedIndex].dataset.id;
                    if (kecamatanId) {
                        populateSelect(desaSelect, `${apiBaseUrl}villages/${kecamatanId}.json`);
                    }
                });

                async function initializeAddress() {
                    if (hasAddress && userAddress.provinsi) {
                        const provinsiId = await populateSelect(provinsiSelect,
                            `${apiBaseUrl}provinces.json`, userAddress.provinsi);
                        if (provinsiId && userAddress.kota) {
                            const kotaId = await populateSelect(kotaSelect,
                                `${apiBaseUrl}regencies/${provinsiId}.json`, userAddress.kota);
                            if (kotaId && userAddress.kecamatan) {
                                const kecamatanId = await populateSelect(kecamatanSelect,
                                    `${apiBaseUrl}districts/${kotaId}.json`, userAddress.kecamatan);
                                if (kecamatanId && userAddress.desa) {
                                    await populateSelect(desaSelect,
                                        `${apiBaseUrl}villages/${kecamatanId}.json`, userAddress.desa);
                                }
                            }
                        }
                    } else {
                        populateSelect(provinsiSelect, `${apiBaseUrl}provinces.json`);
                    }
                }

                initializeAddress();
                });
            </script>
        </section>
    </main>
</x-app-layout>
