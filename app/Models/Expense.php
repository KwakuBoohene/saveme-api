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
        'user_id',
        'category',
        'id',
        'expenseFrom'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
