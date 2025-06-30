<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'name',
        'email',
        'invoice',
        'total',
        'code',
        'pengiriman',
        'pembayaran',
        'tanggal_pemesanan',
        'cost',
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(TransactionsDetail::class, 'invoice', 'invoice');
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class, 'code', 'code');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'code', 'code');
    }
}
