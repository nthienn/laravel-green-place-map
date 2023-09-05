<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'type'
    ];
    protected $primaryKey = 'id_place_type';
    protected $table = 'place_types';
}
