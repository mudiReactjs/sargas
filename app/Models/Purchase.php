<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    use HasFactory;
    protected $table = 'purchases';
    protected $fillable = [
        'code_tr', 'fishermen_id', 'product_id', 'location_id', 'qty', 'total', 'payment_method', 'receipt', 'status'
    ];

    public function fishermen()
    {
        return $this->belongsTo(Fishermen::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
