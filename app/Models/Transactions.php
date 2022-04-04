<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';

    protected $fillable = [
        'users_id',
        'address',
        'payment',
        'total_price',
        'shipping_price',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function transaction_items(){

        return $this->hasMany(TransactionItems::class, 'transactions_id', 'id');
    }


}
