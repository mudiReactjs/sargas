<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiOperasional extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi_operasionals';
    protected $fillable = [
        'transaksi_operasional_id',
        'price',
        ''
    ];
}
