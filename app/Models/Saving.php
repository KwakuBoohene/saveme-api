<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;
    protected $table = "savings";
    protected $fillable = [
        'description',
        'amount',
        'date',
        'user_id',
        'category',
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
