<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $table = "incomes";
    protected $fillable = [
        'source',
        'amount',
        'date',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
