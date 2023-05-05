<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoesImageModel extends Model
{
    use HasFactory;
    protected $table = "shoes_picture";
    protected $primaryKey = "spic_id";

}
