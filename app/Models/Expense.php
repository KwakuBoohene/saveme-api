<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = "expenses";
    protected $fillable = [
        'description',
        'amount',
        'date',
        'account_id',
        'category'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
