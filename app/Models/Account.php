<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = "accounts";
    protected $fillable = [
       'nickname',
       'amount',
       'account_type',
       'user_id'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function accountType(){
        return $this->belongsTo(AccountType::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function entries(){
        return $this->hasMany(Entry::class);
    }


}
