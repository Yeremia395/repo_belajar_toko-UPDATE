<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    public $timestamps = false;

    protected $fillable = ['jumlah', 'bill', 'id_produk'];
}