<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'tanggal_pemesanan',
        'invoice',
        'status',
        'pengiriman',
        'pembayaran',
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(TransactionsDetail::class, 'invoice', 'invoice');
    }
}
