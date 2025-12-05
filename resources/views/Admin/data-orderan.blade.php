<x-admin-layout>
    <h3 class="text-3xl font-medium text-gray-700">Data Orderan</h3>

    <div class="mt-8" x-data="{ showImageModal: false, imagesToShow: [], cancelModalOpen: false, orderToCancel: null, orderNameToCancel: '', processModalOpen: false, orderToProcess: null, orderNameToProcess: '' }">
        {{-- Container ini membuat tabel dapat di-scroll secara horizontal di layar kecil --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        {{-- Kolom Nama dibuat sticky dengan class 'sticky left-0' dan background --}}
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-10">
                            Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Telepon
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Alamat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            RT/RW
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Provinsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kab./Kota
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelurahan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kecamatan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kode Pos
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            File Tas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi Tas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Order
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- Menghitung nomor urut berdasarkan halaman paginasi --}}
                                {{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white">
                                {{ $order->customer_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->customer_email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->customer_phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->shipping_alamat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->shipping_rt_rw }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->shipping_provinsi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->shipping_kota_kabupaten }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->shipping_desa_kelurahan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->shipping_kecamatan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->shipping_kode_pos }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @php
                                    // Pastikan $order->file_foto adalah array sebelum dihitung
                                    $files = is_string($order->file_foto)
                                        ? json_decode($order->file_foto, true)
                                        : $order->file_foto;
                                    $fileCount = is_array($files) ? count($files) : 0;
                                    $publicFileUrls = [];
                                    if ($fileCount > 0) {
                                        $publicFileUrls = array_map(
                                            fn($file) => Illuminate\Support\Facades\Storage::url($file),
                                            $files,
                                        );
                                    }
                                @endphp
                                @if ($fileCount > 0)
                                    <a href="#"
                                        @click.prevent="imagesToShow = {{ json_encode($publicFileUrls) }}; showImageModal = true"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        Lihat File ({{ $fileCount }})
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div class="max-w-xs truncate">
                                    {!! $order->deskripsi !!}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- Logika untuk menampilkan badge status yang berbeda --}}
                                @if ($order->status == 'selesai')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @elseif($order->status == 'dikerjakan')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Dikerjakan
                                    </span>
                                @elseif($order->status == 'dikirim')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        Dikirim
                                    </span>
                                @else
                                    {{-- Default untuk status lain seperti 'pending' --}}
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.orders.edit', $order) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                    @if ($order->status !== 'dikerjakan' && $order->status !== 'dikirim' && $order->status !== 'selesai')
                                        <button
                                            @click.prevent="
                                        processModalOpen = true;
                                        orderToProcess = '{{ route('admin.orders.process', $order) }}';
                                        orderNameToProcess = '{{ $order->customer_name }}';
                                    "
                                            class="text-green-600 hover:text-green-900">Proses</button>
                                    @endif

                                    <button
                                        @click.prevent="
                                            cancelModalOpen = true;
                                            orderToCancel = '{{ route('admin.orders.cancel', $order) }}';
                                            orderNameToCancel = '{{ $order->customer_name }}';
                                        "
                                        class="text-red-600 hover:text-red-900">Batalkan</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="16" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data orderan ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Menampilkan link paginasi --}}
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
        <!-- Process Confirmation Modal -->
        <div x-show="processModalOpen" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div @click.away="processModalOpen = false" class="w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900">Konfirmasi Proses</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin memproses orderan dari <strong
                                x-text="orderNameToProcess"></strong>?
                        </p>
                    </div>
                </div>
                <div class="mt-4 flex justify-center space-x-4">
                    <button @click="processModalOpen = false" type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Tidak
                    </button>
                    <form :action="orderToProcess" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">Ya,
                            Proses</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Cancel Confirmation Modal -->
        <div x-show="cancelModalOpen" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div @click.away="cancelModalOpen = false" class="w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl">
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900">Konfirmasi Pembatalan</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Apakah Anda yakin ingin membatalkan orderan dari <strong x-text="orderNameToDelete"></strong>?
                        </p>
                    </div>
                </div>
                <div class="mt-4 flex justify-center space-x-4">
                    <button @click="cancelModalOpen  = false" type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Tidak
                    </button>
                    <form :action="orderToCancel" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">Ya,
                            Batalkan</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Image Preview Modal -->
        <div x-show="showImageModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div @click.away="showImageModal = false"
                class="relative w-full max-w-4xl p-4 mx-4 bg-white rounded-lg shadow-xl"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <div class="flex items-center justify-between pb-3 border-b">
                    <h3 class="text-2xl font-semibold">Preview Gambar</h3>
                    <button @click="showImageModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mt-4 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                        <template x-for="image in imagesToShow" :key="image">
                            <div class="p-2 border rounded-lg">
                                <img :src="image" alt="Preview Gambar Order"
                                    class="object-contain w-full h-48 rounded">
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
