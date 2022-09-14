<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofDebt extends Model
{
    use HasFactory;

    protected $table = 'proof_debts';
    protected $fillable = [
        'debt_id', 'image'
    ];
}
