<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        return view('/order');
    }
    public function store(Request $request)
    {
        $rules = [
            // Aturan untuk alamat (wajib untuk semua)
            'shipping_alamat' => 'required|string|max:255',
            'shipping_rt_rw' => 'required|string|max:10',
            'shipping_provinsi' => 'required|string|max:255',
            'shipping_kota_kabupaten' => 'required|string|max:255',
            'shipping_kecamatan' => 'required|string|max:255',
            'shipping_desa_kelurahan' => 'required|string|max:255',
            'shipping_kode_pos' => 'required|string|max:10',

            // Aturan untuk detail pesanan
            'deskripsi' => 'required|string',
            'file_foto' => 'required|array',
            'file_foto.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB per file
        ];

        // Tambahkan aturan validasi untuk tamu
        if (!Auth::check()) {
            $rules['customer_name'] = 'required|string|max:255';
            $rules['customer_email'] = 'required|email|max:255';
            $rules['customer_phone'] = 'required|string|max:20';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('order')
                ->withErrors($validator)
                ->withInput();
        }

        $order = new Order();

        // Generate nomor order unik
        $order->order_number = 'TIARE-' . strtoupper(Str::random(8));

        if (Auth::check()) {
            $user = Auth::user();
            $order->user_id = $user->id;
            $order->customer_name = $user->nama;
            $order->customer_email = $user->email;
            $order->customer_phone = $user->no_hp;
        } else {
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
        }

        $order->fill($request->only([
            'shipping_alamat', 'shipping_rt_rw', 'shipping_provinsi', 'shipping_kota_kabupaten',
            'shipping_kecamatan', 'shipping_desa_kelurahan', 'shipping_kode_pos', 'deskripsi'
        ]));

        // Handle file uploads
        if ($request->hasFile('file_foto')) {
            $paths = [];
            foreach ($request->file('file_foto') as $file) {
                // Store the file in storage/app/public/order_photos and get its path
                $path = $file->store('order_photos', 'public');
                $paths[] = $path;
            }
            // Save the paths array. Laravel will handle JSON encoding due to the cast in the model.
            $order->file_foto = $paths;
        }

        $order->status = 'Pending';
        $order->payment_status = 'Unpaid';

        $order->save();

        return redirect()->route('order.success', ['order' => $order->id]);
    }

    public function success(Order $order)
    {
        return view('order-success', ['order' => $order]);
    }
}