<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fishermen extends Model
{
    use HasFactory;

    protected $table = 'fishermens';
    protected $fillable = [
        'name', 'address', 'no_tlp','location_id', 'product_id','tool','family_amount','image','status'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
