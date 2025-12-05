<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Di sini Anda akan mengambil data orderan dari database
        $orders = Order::where('status', 'pending')->latest()->paginate(10);

        return view('Admin.data-orderan', ['orders' => $orders]);
    }
    public function dikerjakan()
    {
        $orders = Order::where('status', 'dikerjakan')->latest()->paginate(10);
        return view('Admin.orderan-dikerjakan', compact('orders'));
    }
    public function dikirim()
    {
        $orders = Order::where('status', 'dikirim')->latest()->paginate(10);
        return view('Admin.orderan-dikirim', compact('orders'));
    }
    public function selesai()
    {
        $orders = Order::where('status', 'selesai')->latest()->paginate(10);
        return view('Admin.orderan-selesai', compact('orders'));
    }

    public function dibatalkan()
    {
        $orders = Order::where('status', 'dibatalkan')->latest()->paginate(10);
        return view('Admin.dibatalkan', compact('orders'));
    }
    public function cancel(Order $order)
    {
        // Mengubah status menjadi 'dibatalkan'
        $order->update(['status' => 'dibatalkan']);

        // Redirect kembali ke halaman data-orderan dengan pesan sukses
        return redirect()->route('admin.data-orderan')->with('success', 'Orderan telah dibatalkan.');
    }


    public function edit(Order $order)
    {
        return view('Admin.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // Validasi bisa ditambahkan di sini
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'status' => 'required|string|in:pending,dikerjakan,dikirim,selesai,dibatalkan', // Pastikan status valid
            'shipping_alamat' => 'required|string|max:255',
            'shipping_rt_rw' => 'required|string|max:10',
            'shipping_provinsi' => 'required|string|max:255',
            'shipping_kota_kabupaten' => 'required|string|max:255',
            'shipping_kecamatan' => 'required|string|max:255',
            'shipping_desa_kelurahan' => 'required|string|max:255',
            'shipping_kode_pos' => 'required|string|max:10',
            'deskripsi' => 'nullable|string',
        ]);

        $order->update($validatedData);

        return redirect()->route('admin.data-orderan')->with('success', 'Orderan berhasil diperbarui.');
    }

    public function process(Order $order)
    {
        // Mengubah status menjadi 'dikerjakan'
        $order->update(['status' => 'dikerjakan']);

        // Redirect ke halaman 'orderan-dikerjakan'
        return redirect()->route('admin.orders.dikerjakan')->with('success', 'Orderan telah dipindahkan ke "Orderan Dikerjakan".');
    }

    public function destroy(Order $order)
    {
        // Logika untuk menghapus file gambar dari storage jika ada
        if ($order->file_foto) {
            foreach ($order->file_foto as $file) {
                \Illuminate\Support\Facades\Storage::delete($file);
            }
        }
        $order->delete();
        return redirect()->route('admin.data-orderan')->with('success', 'Orderan berhasil dihapus.');
    }
}