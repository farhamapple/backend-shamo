<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_items';

    protected $fillable = [
        'users_id',
        'products_id',
        'transactions_id',
        'quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function transactions(){
        return $this->belongsTo(Transactions::class, 'transactions_id', 'id');
    }

    public function products(){
        return $this->hasMany(Products::class, 'products_id', 'id');
    }
}
