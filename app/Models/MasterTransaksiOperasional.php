<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTransaksiOperasional extends Model
{
    use HasFactory;

    protected $table = 'master_transaksi_operasionals';
    protected $fillable = [
        'code', 'name', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
