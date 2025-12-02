<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => fake()->name(),
            'customer_email' => fake()->unique()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'shipping_alamat' => fake()->address(),
            'shipping_rt_rw' => fake()->bothify('RT##/RW##'),
            'shipping_provinsi' => fake()->state(),
            'shipping_kota_kabupaten' => fake()->city(),
            'shipping_kecamatan' => fake()->city(),
            'shipping_desa_kelurahan' => fake()->city(),
            'shipping_kode_pos' => fake()->postcode(),
            'file_foto' => 'order_photos/' . fake()->uuid() . fake()->randomElement(['.jpg', '.png', '.jpeg']),
            'deskripsi' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'completed']),
            'total_price' => fake()->randomFloat(2, 100, 1000),
            'order_number' => 'INV/' . now()->year . '/' . fake()->unique()->randomNumber(6),
            'payment_method' => fake()->randomElement(['manual_transfer_bca', 'cod']),
            'payment_status' => fake()->randomElement(['unpaid', 'paid']),
            'paid_at' => fake()->optional()->dateTimeThisMonth(),
            'shipping_courier' => fake()->optional()->randomElement(['JNE', 'J&T', 'Sicepat']),
            'shipping_tracking_number' => fake()->optional()->bothify('??##########'),
        ];
    }
}