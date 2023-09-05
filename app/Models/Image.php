<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id_place', 'image'
    ];
    protected $primaryKey = 'id_image';
    protected $table = 'images';
}
