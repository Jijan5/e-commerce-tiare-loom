<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_alamat',
        'shipping_rt_rw',
        'shipping_provinsi',
        'shipping_kota_kabupaten',
        'shipping_kecamatan',
        'shipping_desa_kelurahan',
        'shipping_kode_pos',
        'file_foto',
        'deskripsi',
        'status',
        'total_price',
        'order_number',
        'payment_method',
        'payment_status',
        'paid_at',
        'shipping_courier',
        'shipping_tracking_number',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}