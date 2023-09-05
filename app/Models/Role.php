<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'role', 'roleName'
    ];
    protected $primaryKey = 'id_role';
    protected $table = 'roles';
}
