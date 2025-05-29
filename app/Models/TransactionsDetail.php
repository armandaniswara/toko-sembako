<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';

    protected $fillable = [
        'invoice',
        'sku',
        'qty',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'sku', 'sku');
    }

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'invoice', 'invoice');
    }
}
