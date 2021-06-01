<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $table = "entries";
    protected $fillable = [
        'description',
        'source',
        'amount',
        'date',
        'account_id',
        'category'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
