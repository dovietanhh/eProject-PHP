<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeSizeModel extends Model
{
    use HasFactory;
    protected $table = "shoes_size";
    protected $primaryKey = "size_id";

}
