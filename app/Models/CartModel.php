<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $table = "cart";
    protected $primaryKey = "cart_id";
    protected $fillable = ["customer_id","shoes_size_id","quantity_cart",];



}
