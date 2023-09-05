<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'approve'
    ];
    protected $primaryKey = 'id_approve';
    protected $table = 'approves';
}
