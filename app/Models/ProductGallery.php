<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_galleries';

    protected $fillable = [
        'products_id',
        'url',
    ];

    public function products(){
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }

    public function getUrllAttribute($url){
        return config('app.url').Storage::url($url);
    }

}
