<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Kolom untuk pesanan tamu (guest)
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            // Alamat pengiriman untuk pesanan ini
            $table->string('shipping_alamat');
            $table->string('shipping_rt_rw');
            $table->string('shipping_provinsi');
            $table->string('shipping_kota_kabupaten');
            $table->string('shipping_kecamatan');
            $table->string('shipping_desa_kelurahan');
            $table->string('shipping_kode_pos');

            // Detail kustomisasi pesanan
            $table->string('file_foto')->comment('Path ke file gambar contoh dari customer');
            $table->text('deskripsi')->comment('Deskripsi detail keinginan customer');

            // Informasi pesanan lainnya
            $table->string('status')->default('pending'); // Contoh: pending, processing, shipped, completed
            $table->decimal('total_price', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};