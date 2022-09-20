<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sack extends Model
{
    use HasFactory;

    protected $table = 'sacks';
    protected $fillable = [
        'fishermen_id', 'sack_brought', 'sack_deposit', 'residual'
    ];

    public function fishermen()
    {
        return $this->belongsTo(Fishermen::class);
    }
}
