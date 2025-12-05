<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        // Ambil pesanan yang masih aktif (bukan 'selesai' atau 'dibatalkan')
        $activeOrders = $user->orders()
            ->whereNotIn('status', ['selesai', 'dibatalkan'])
            ->latest()->get();

        // Ambil pesanan yang sudah masuk riwayat ('selesai' atau 'dibatalkan')
        $historyOrders = $user->orders()
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->latest()->get();

        return view('profile.profile', [
            'user' => $user,
            'activeOrders' => $activeOrders,
            'historyOrders' => $historyOrders,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateDetails(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_hp' => ['required', 'string', 'max:20'],
        ]);

        $user->fill($request->only(['nama', 'email', 'no_hp']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-details-updated');
    }

    /**
     * Update the user's address information.
     */
    public function updateAddress(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'alamat' => ['required', 'string', 'max:255'],
            'rt_rw' => ['required', 'string', 'max:10'],
            'provinsi' => ['required', 'string', 'max:255'],
            'kota_kabupaten' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'desa_kelurahan' => ['required', 'string', 'max:255'],
            'kode_pos' => ['required', 'string', 'max:10'],
        ]);

        $user->fill($request->only([
            'alamat', 'rt_rw', 'provinsi', 'kota_kabupaten', 'kecamatan', 'desa_kelurahan', 'kode_pos'
        ]));

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-address-updated');
    }
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirect back to the security tab with a success message
        return back()->with('status', 'password-updated')->with('tab', 'security');
    }
}