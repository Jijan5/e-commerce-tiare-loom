<x-app-layout>
    <main>
        <div class="container mx-auto py-16 px-4">
            <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold text-center mb-6">Sign Up</h1>
                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input id="nama"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="text"
                            name="nama" value="{{ old('nama') }}" required autofocus />
                    </div>
                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input id="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="email"
                            name="email" value="{{ old('email') }}" required />
                    </div>
                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="no_hp" class="block text-gray-700 text-sm font-bold mb-2">Phone Number
                            (WhatsApp)</label>
                        <input id="no_hp"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" type="tel"
                            name="no_hp" value="{{ old('no_hp') }}" required />
                    </div>
                    <div class="mt-6 pt-6 border-t">
                        <h2 class="text-lg font-semibold text-center text-gray-800 mb-4">Shipping Address (Optional)
                        </h2>
                        <p class="mb-2 text-red-600">NOTE: If you do not fill in your address during registration, you
                            must fill in your address when placing an order.</p>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                            <input id="alamat"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                type="text" name="alamat" value="{{ old('alamat') }}" />
                        </div>

                        <!-- RT/RW -->
                        <div class="mb-4">
                            <label for="rt_rw" class="block text-gray-700 text-sm font-bold mb-2">RT/RW</label>
                            <input id="rt_rw"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                type="text" name="rt_rw" value="{{ old('rt_rw') }}" />
                        </div>

                        <!-- Provinsi -->
                        <div class="mb-4">
                            <label for="provinsi" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                            <select id="provinsi" name="provinsi"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                                <option value="">-- Choose Province --</option>
                            </select>
                        </div>

                        <!-- Kota/Kabupaten -->
                        <div class="mb-4">
                            <label for="kota_kabupaten"
                                class="block text-gray-700 text-sm font-bold mb-2">City/District</label>
                            <select id="kota_kabupaten" name="kota_kabupaten"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" disabled>
                                <option value="">-- Choose City/District --</option>
                            </select>
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-4">
                            <label for="kecamatan"
                                class="block text-gray-700 text-sm font-bold mb-2">Subdistrict</label>
                            <select id="kecamatan" name="kecamatan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" disabled>
                                <option value="">-- Choose Subdistrict --</option>
                            </select>
                        </div>

                        <!-- Desa/Kelurahan -->
                        <div class="mb-4">
                            <label for="desa_kelurahan"
                                class="block text-gray-700 text-sm font-bold mb-2">Village/Ward</label>
                            <select id="desa_kelurahan" name="desa_kelurahan"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" disabled>
                                <option value="">-- Choose Village/Ward --</option>
                            </select>
                        </div>

                        <!-- Kode Pos -->
                        <div class="mb-4">
                            <label for="kode_pos" class="block text-gray-700 text-sm font-bold mb-2">Postal Code</label>
                            <input id="kode_pos"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                type="text" name="kode_pos" value="{{ old('kode_pos') }}" />
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="mb-4" x-data="{ show: false }">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <div class="relative">
                            <input id="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 pr-10"
                                :type="show ? 'text' : 'password'" name="password" required />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="show = !show" class="focus:outline-none">
                                    <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="show" style="display: none;" class="w-6 h-6 text-gray-800"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="mb-6" x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm
                            Password</label>
                        <div class="relative">
                            <input id="password_confirmation"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 pr-10"
                                :type="show ? 'text' : 'password'" name="password_confirmation" required />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="show = !show" class="focus:outline-none">
                                    <svg x-show="!show" class="w-6 h-6 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="show" style="display: none;" class="w-6 h-6 text-gray-800"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <span id="password-match-error" class="text-red-500 text-xs italic mt-1"
                            style="display: none;">Passwords do not match.</span>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded cursor-pointer">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Indonesian Regions Dropdown Logic ---
            const apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api/';
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota_kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const desaSelect = document.getElementById('desa_kelurahan');

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
                resetAndDisable(kotaSelect, '-- Choose City/District --');
                resetAndDisable(kecamatanSelect, '-- Choose Subdistrict --');
                resetAndDisable(desaSelect, '-- Choose Village/Ward --');
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
                resetAndDisable(kecamatanSelect, '-- Choose Subdistrict --');
                resetAndDisable(desaSelect, '-- Choose Village/Ward --');
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
                resetAndDisable(desaSelect, '-- Choose Village/Ward --');
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
            // Real-time password match validation
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const passwordMatchError = document.getElementById('password-match-error');

            function checkPasswordMatch() {
                if (passwordInput.value !== confirmPasswordInput.value && confirmPasswordInput.value !== '') {
                    passwordMatchError.style.display = 'block';
                    confirmPasswordInput.setCustomValidity("Passwords don't match"); // Mencegah submit form
                } else {
                    passwordMatchError.style.display = 'none';
                    confirmPasswordInput.setCustomValidity(''); // Mengizinkan submit form
                }
            }

            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        });
    </script>
</x-app-layout>
