<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Menghitung jumlah pesanan berdasarkan status
        $ordersPending = Order::where('status', 'pending')->count();
        $ordersDikerjakan = Order::where('status', 'dikerjakan')->count();
        $ordersDikirim = Order::where('status', 'dikirim')->count();
        $ordersSelesai = Order::where('status', 'selesai')->count();
        $ordersDibatalkan = Order::where('status', 'dibatalkan')->count();

        // Mengirim data ke view
        return view('Admin.dashboard', compact(
            'ordersPending',
            'ordersDikerjakan',
            'ordersDikirim',
            'ordersSelesai',
            'ordersDibatalkan'
        ));
    }
}