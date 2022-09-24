<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiOperasional extends Model
{
    use HasFactory;
    protected $table = 'transaksi_operasionals';
    protected $fillable = [
        'master_transaksi_operasional_id',
        'price_total',
        'description',
        'payment_method',
        'bukti_bayar'
    ];
}
