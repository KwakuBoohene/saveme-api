<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;
    protected $table = "summaries";
    protected $fillable = [
        'net_income',
        'net_debt',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
