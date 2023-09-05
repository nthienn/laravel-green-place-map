<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'criteria', 'id_place'
    ];
    protected $primaryKey = 'id_criteria';
    protected $table = 'criterias';
}
