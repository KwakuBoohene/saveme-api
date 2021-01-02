<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    use HasFactory;
    protected $table = "creditors";
    protected $fillable = [
        'name',
        'amount',
        'date',
        'payment_deadline',
        'paid',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
