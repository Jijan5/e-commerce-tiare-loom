<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all user IDs
        $users = User::all();

        if ($users->isEmpty()) {
            return;
        }

        // Create 20 orders for existing users
        // We loop because we need to pull specific data from a random user
        for ($i = 0; $i < 45; $i++) {
            $user = $users->random();
            Order::factory()->create([
                'user_id' => $user->id,
                'customer_name' => $user->nama,
                'customer_email' => $user->email,
                'customer_phone' => $user->no_hp,
            ]);
        }

        // Create 5 guest orders
        Order::factory()->count(5)->create([
            'user_id' => null,
        ]);
    }
}