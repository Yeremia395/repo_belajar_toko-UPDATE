<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    protected $fillable = ['nama_produk', 'tanggal_exp', 'harga_produk'];
}